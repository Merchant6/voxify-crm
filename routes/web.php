<?php

use App\Http\Controllers\PvTableController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('pv-upload', [PvTableController::class, 'create'])
    ->middleware(['auth'])
    ->name('pv');

Route::get('pv-table', [PvTableController::class, 'index'])
->middleware(['auth'])
->name('pv-table');    

Route::get('pv-pdf', [PvTableController::class, 'createdPdf'])
    ->middleware('auth')
    ->name('pv-pdf');

require __DIR__.'/auth.php';
