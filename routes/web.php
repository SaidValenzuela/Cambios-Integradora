<?php

use App\Http\Controllers\TripController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use Illuminate\Routing\ViewController;

// Vista Panel de Control
Route::get('/dashboard', [ViewsController::class, 'viewDashboard'])->name('dashboard');

// Vista y manejo de viajes
Route::get('/trips', [TripController::class, 'viewViajes'])->name('trips');
Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
Route::post('/trips/{id}', [TripController::class, 'update'])->name('trips.update');
Route::delete('/trips/{id}', [TripController::class, 'destroy'])->name('trips.destroy');

// Vista y manejo de viajes
Route::get('/reservations', [ReservationController::class, 'viewReservaciones'])->name('reservations');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/resertations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// Vista Viajes Prueba
Route::get('/example', [ExampleController::class, 'viewExample'])->name('example');

// Vista Viajes Próximos
Route::get('/viajes', [ViewsController::class, 'viewViajes'])->name('viajes');