<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;

// Route utama mengarah ke Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource Routes untuk CRUD
Route::resource('rooms', RoomController::class);
Route::resource('reservations', ReservationController::class);