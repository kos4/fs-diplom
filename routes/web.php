<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/hall/{movieSessionId}', 'hall')->name('hall');
    Route::get('/payment', 'payment')->name('payment');
    Route::get('/ticket/{id}', 'ticket')->name('ticket');
});

Route::prefix('ajax')->controller(AjaxController::class)->group(function () {
    Route::post('/dates', 'dates');
    Route::post('/set-chosen-date', 'setChosenDate');
    Route::post('/save-order', 'saveOrder');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

        Route::resource('/api/halls', App\Http\Controllers\HallController::class);
        Route::resource('/api/prices', App\Http\Controllers\PriceController::class)->only(['store', 'update']);
        Route::resource('/api/movies', App\Http\Controllers\MovieController::class)->except(['index', 'show']);
        Route::resource('/api/movie-sessions', App\Http\Controllers\MovieSessionController::class)->except(['index', 'show']);
        Route::post('/api/open-sale', [App\Http\Controllers\AdminController::class, 'openSale']);
    });
});
