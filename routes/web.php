<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Panel routes
Route::group(
    [
        'as' => 'panel.',
        'prefix' => 'panel',
    ],
    function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
        include __DIR__ . '/panel/auth.php';
        include __DIR__ . '/panel/content.php';
        include __DIR__ . '/panel/category.php';
        include __DIR__ . '/panel/user.php';
        include __DIR__ . '/panel/menu.php';
    }
);


// Main page routes
Route::get('/', [HomeController::class, 'home'])->name('home');

// TODO : Create a route for displaying contents of each category
// Route::get('/{categorySlug}', [HomeController::class, 'contentsByCategory'])->name('contents.contents_by_category');

Route::get('/{categorySlug}', [HomeController::class, 'contentByCategory'])->name('contents.content_by_category');
Route::get('/{categorySlug}/{contentSlug}', [HomeController::class, 'show'])
    ->name('contents.show');