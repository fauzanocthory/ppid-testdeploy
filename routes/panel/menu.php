<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'menu',
        'as' => 'menus.',
        'middleware' => 'auth'
    ],
    function () {
        // TODO : Menu Management
        // Add your menu management routes here
    }
);