<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::get('/admin-count', [UserControler::class, 'getAdminCount']);
    Route::resource('users', UserControler::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});
