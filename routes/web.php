<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listings', ListingController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');
Route::resource('listings', ListingController::class)
    ->only(['index', 'show']);

Route::get('login', [AuthController::class, 'dspLoginForm'])->name('show.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [RegisterUserController::class, 'showRegistrationForm'])->name('show.register');
Route::post('register', [RegisterUserController::class, 'register'])->name('register');
