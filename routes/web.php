<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//--- Route to the home page (Landing Page) ---//
Route::get(
    '/',
    function () {
        return view('welcome');
    }
)->name('home');

//--- Breeze-generated authentication routes ---//
require __DIR__ . '/auth.php';

//--- Routes requiring authentication ---//
Route::middleware(['auth', 'verified'])->group(function () {

    // User dashboard //
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User profile management //
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for reservation management (accessible to customers and admins) //
    Route::resource('reservations', ReservationController::class)->except(['destroy']);
    Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    // Admin-specific routes //
    Route::middleware(['admin'])->group(function () {
        // Table management
        Route::resource('tables', TableController::class);

        // Administrative management of reservations
        Route::get('/admin/reservations', [
            ReservationController::class,
            'adminIndex'
        ])->name('admin.reservations.index');
        Route::patch('/reservations/{reservation}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
        Route::delete('/reservations/{reservation}/delete', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    });
});
