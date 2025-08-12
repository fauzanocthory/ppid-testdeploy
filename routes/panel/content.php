<?php

use App\Http\Controllers\Panel\ContentController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'konten',
        'as' => 'contents.',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', [ContentController::class, 'index'])->name('index');
        Route::get('/data', [ContentController::class, 'data'])->name('data');
        Route::get('/tambah', [ContentController::class, 'create'])->name('create');
        Route::post('/store', [ContentController::class, 'store'])->name('store');
        Route::get('/{content}', [ContentController::class, 'show'])->name('show');
        Route::get('/{content}/edit', [ContentController::class, 'edit'])->name('edit');
        Route::put('/{content}', [ContentController::class, 'update'])->name('update');
        Route::delete('/{content}', [ContentController::class, 'destroy'])->name('destroy');
    }
);