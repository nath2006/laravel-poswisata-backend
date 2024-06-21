<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControler;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::resource('users', UserControler::class);
});
