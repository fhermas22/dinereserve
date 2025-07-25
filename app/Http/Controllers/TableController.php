<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
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
        Log::info('New table created: ' . $request->name);
        return redirect()->route('tables.index')->with('success', 'Table created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        return view('tables.show', compact('table'));
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
        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table->delete();
        Log::warning('Table deleted: ' . $table->name);
        return redirect()->route('tables.index')->with('success', 'Table deleted successfully.');
    }
}
