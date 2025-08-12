<?php

use App\Http\Controllers\Panel\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'kategori',
        'as' => 'categories.',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/data', [CategoryController::class, 'data'])->name('data');
        Route::get('/tambah', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('delete');
    }
);

