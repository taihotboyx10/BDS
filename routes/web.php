<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\RealtorListingController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listings', ListingController::class)
    ->only(['index']);

Route::get('login', [AuthController::class, 'dspLoginForm'])->name('show.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [RegisterUserController::class, 'showRegistrationForm'])->name('show.register');
Route::post('register', [RegisterUserController::class, 'register'])->name('register');

// realtor route group
Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
->group(function () {
    Route::resource('listing', RealtorListingController::class)
        ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
        ->name('listing.restore')
        ->withTrashed();
});