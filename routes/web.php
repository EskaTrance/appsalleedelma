<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ReservationController::class, 'calendar'])->name('reservations.calendar');
Route::get('reservations/calendar', [ReservationController::class, 'calendar'])->name('reservations.calendar');
Route::get('reservations/get-reservations', [ReservationController::class, 'getReservations']);
Route::get('reservations/{reservation}/editxhr', [ReservationController::class, 'editxhr']);
Route::get('reservations/createxhr', [ReservationController::class, 'createxhr']);
Route::resource('reservations', ReservationController::class);
Route::get('clients/get-clients-json', [ClientController::class, 'getClientsJson']);
Route::resource('clients', ClientController::class);
