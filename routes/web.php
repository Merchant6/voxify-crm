<?php

use App\Http\Controllers\PvTableController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('pv-table', [PvTableController::class, 'index'])
    ->middleware(['auth'])
    ->name('pv');

require __DIR__.'/auth.php';
