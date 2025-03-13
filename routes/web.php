<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

        Route::resource('/api/halls', App\Http\Controllers\HallController::class)->except([
            'index', 'show'
        ]);
    });
});
