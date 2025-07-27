<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Mail\ReservationConfirmed;
use App\Mail\ReservationCancelled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewReservationNotification;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $reservations = Reservation::with(['user', 'table'])
                ->orderBy('reservation_date', 'desc')
                ->orderBy('reservation_time', 'desc')
                ->paginate(15);
        } else {
            $reservations = Auth::user()->reservations()
                ->with('table')
                ->orderBy('reservation_date', 'desc')
                ->orderBy('reservation_time', 'desc')
                ->paginate(15);
        }

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Admin reservations index.
     */
    public function adminIndex()
    {
        $reservations = Reservation::with(['user', 'table'])
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'desc')
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('is_available', true)->orderBy('name')->get();
        return view('reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $validatedData = $request->validated();
        $tableId = $validatedData['table_id'];
        $reservationDate = Carbon::parse($validatedData['reservation_date'])->toDateString();
        $reservationTime = Carbon::parse($validatedData['reservation_time'])->toTimeString();

        $isTableAvailable = $this->checkTableAvailability(
            $tableId,
            $reservationDate,
            $reservationTime
        );
        if (!$isTableAvailable) {
            return back()->withInput()->withErrors([
                'table_id' => 'Cette table n\'est pas disponible pour la date et l\'heure sélectionnées.'
            ]);
        }

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
        }

        $reservation = Reservation::create($validatedData);

        // Notify the admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewReservationNotification($reservation));

        Log::info('New reservation created: ' . $reservation->id);

        return redirect()->route('reservations.index')
            ->with('success', 'Votre réservation a été créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        if (!in_array($reservation->status, ['pending', 'confirmed'])) {
            return redirect()->route('reservations.index')
                ->with('error', 'Cette réservation ne peut plus être modifiée.');
        }

        $tables = Table::where('is_available', true)->orderBy('name')->get();
        return view('reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $validatedData = $request->validated();
        $tableId = $validatedData['table_id'];
        $reservationDate = Carbon::parse($validatedData['reservation_date'])->toDateString();
        $reservationTime = Carbon::parse($validatedData['reservation_time'])->toTimeString();

        if (
            $reservation->table_id != $tableId ||
            $reservation->reservation_date->toDateString() != $reservationDate ||
            $reservation->reservation_time->toTimeString() != $reservationTime
        ) {
            $isTableAvailable = $this->checkTableAvailability(
                $tableId,
                $reservationDate,
                $reservationTime,
                $reservation->id
            );
            if (!$isTableAvailable) {
                return back()->withInput()->withErrors([
                    'table_id' => 'Cette table n\'est pas disponible pour la date et l\'heure sélectionnées.'
                ]);
            }

            $reservation->update($validatedData);
            Log::info('Reservation updated: ' . $reservation->id);
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Cancel the reservation.
     */
    public function cancel(Request $request, Reservation $reservation)
    {
        if (!Auth::user()->isAdmin() && Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        if (!$reservation->canBeCancelled()) {
            return back()->with('error', 'Cette réservation ne peut pas être annulée.');
        }

        $reservation->cancel($request->input('reason'));

        // Send the cancellation email
        Mail::to($reservation->customer_email)->send(new ReservationCancelled($reservation));

        Log::info('Reservation cancelled: ' . $reservation->id);

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Confirm the reservation (Admin only).
     */
    public function confirm(Reservation $reservation)
    {
        if (!$reservation->canBeConfirmed()) {
            return back()->with('error', 'Cette réservation ne peut pas être confirmée.');
        }

        $reservation->confirm();

        // Send the confirmation email
        Mail::to($reservation->customer_email)->send(new ReservationConfirmed($reservation));

        Log::info('Reservation confirmed: ' . $reservation->id);

        return back()->with('success', 'Réservation confirmée avec succès.');
    }

    /**
     * Remove the specified resource from storage (Admin only).
     */
    public function destroy(Reservation $reservation)
    {
        $reservationId = $reservation->id;
        $reservation->delete();
        Log::warning('Reservation deleted: ' . $reservationId);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }

    /**
     * Check if a table is available for a specific date and time.
     */
    private function checkTableAvailability(
        int $tableId,
        string $date,
        string $time,
        int $excludeReservationId = null
    ): bool {
        $table = Table::find($tableId);
        if (!$table || !$table->is_available) {
            return false;
        }
        $query = Reservation::where('table_id', $tableId)
            ->where('reservation_date', $date)
            ->where('reservation_time', $time)
            ->whereIn('status', ['pending', 'confirmed']);
        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return !$query->exists();
    }
}
