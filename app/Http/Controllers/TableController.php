<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all tables ordered by name
        $tables = Table::orderBy('name')->get();
        Log::info('Admin accessed table listing.');
        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        // The data is already validated by StoreTableRequest
        Table::create($request->validated());
        Log::info('New table created: ' . $request->{'name'});
        return redirect()->route('tables.index')->with('success', 'Table créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        $reservations = $table->reservations()
            ->with('user')
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'desc')
            ->paginate(10);

        return view('tables.show', compact('table', 'reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $table->update($request->validated());
        Log::info('Table updated: ' . $table->name);
        return redirect()->route('tables.index')->with('success', 'Table mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $activeReservations = $table->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        if ($activeReservations > 0) {
            return redirect()->route('tables.index')
                ->with('error', 'Impossible de supprimer cette table car elle a des réservations actives.');
        }

        $tableName = $table->name;
        $table->delete();
        Log::warning('Table deleted: ' . $tableName);
        return redirect()->route('tables.index')->with('success', 'Table supprimée avec succès.');
    }
}
