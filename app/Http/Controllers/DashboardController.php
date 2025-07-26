<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->customerDashboard();
        }
    }

    /**
     * Admin dashboard.
     */
    private function adminDashboard()
    {
        $stats = [
            'total_reservations' => Reservation::count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'confirmed_reservations' => Reservation::where(
                'status',
                'confirmed'
            )->count(),
            'total_tables' => Table::count(),
            'available_tables' => Table::where('is_available', true)->count(),
            'total_customers' => User::where('role', 'customer')->count(),
        ];

        $recentReservations = Reservation::with(['user', 'table'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $todayReservations = Reservation::with(['user', 'table'])
            ->whereDate('reservation_date', Carbon::today())
            ->orderBy('reservation_time')
            ->get();

        return view('dashboard.admin', compact(
            'stats',
            'recentReservations',
            'todayReservations'
        ));
    }

    /**
     * Customer dashboard.
     */
    private function customerDashboard()
    {
        $user = Auth::user();

        $upcomingReservations = $user->reservations()
            ->with('table')
            ->where('reservation_date', '>=', Carbon::today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->get();

        $pastReservations = $user->reservations()
            ->with('table')
            ->where('reservation_date', '<', Carbon::today())
            ->orWhereIn('status', ['cancelled', 'completed'])
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_reservations' => $user->reservations()->count(),
            'upcoming_reservations' => $upcomingReservations->count(),
            'completed_reservations' => $user->reservations()->where(
                'status',
                'completed'
            )->count(),
        ];

        return view('dashboard.customer', compact(
            'upcomingReservations',
            'pastReservations',
            'stats'
        ));
    }
}
