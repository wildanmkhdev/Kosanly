<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get(
    '/',
    [HomeController::class, 'index']
);
Route::get(
    'home',
    [HomeController::class, 'index']
)->name('home');
Route::get(
    'check-booking',
    [BookingController::class, 'check']
)
    ->name('check-booking');
