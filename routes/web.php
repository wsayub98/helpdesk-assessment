<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('tickets')->middleware(['auth', 'verified'])
    ->group(function() {
        Route::get('/', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/store', [TicketController::class, 'store'])->name('tickets.store');
        Route::delete('/delete/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::get('/edit/{ticket}', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/update/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    });

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
