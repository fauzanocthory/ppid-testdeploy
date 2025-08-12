<?php

use App\Http\Controllers\Panel\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'auth.'
    ],
    function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login_form')->middleware('guest');
        Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    }
);