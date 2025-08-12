<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'user',
        'as' => 'users.',
        'middleware' => 'auth'
    ],
    function () {
        // TODO : User Management
        // Add your user management routes here
    }
);