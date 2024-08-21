<?php

use App\Actions\DeleteProcessedFile;
use App\Http\Controllers\DoctorOrderController;
use App\Http\Controllers\PvTableController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('doctor-form', [DoctorOrderController::class, 'create'])
    ->middleware('auth')
    ->name('doctor-form');    

Route::get('delete/sheet', function () {
    return DeleteProcessedFile::run(request()->query('id'));
})
->name('delete-sheet');

// Route::get('doctor-orders', [DoctorOrderController::class, 'index'])
//     ->middleware('auth')
//     ->name('doctor-orders');

require __DIR__.'/auth.php';
