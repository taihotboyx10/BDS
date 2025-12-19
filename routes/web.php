<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listings', ListingController::class)
    ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);