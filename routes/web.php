<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Tugas;

use Illuminate\Http\Request;

Route::redirect('/', 'login');

Route::prefix('articles')
        ->as('articles.')
        ->controller(Controllers\ArticleController::class)
        ->group(function () {

    Route::get('/', 'index')->name('index');

});

Route::prefix('tugas')
        ->name('tugas.')
        ->group(function () {

    Route::get('profile', [Tugas\ProfileController::class, 'index'])->name('profile');

});


Route::middleware('guestUser')
->group(function () {

    Route::controller(Controllers\AuthController::class)
    ->name('login')
    ->prefix('login')
    ->group(function () {
        Route::get('/', 'loginView');
        Route::post('/', 'login');
    });

});

Route::middleware('users')
->group(function () {

    Route::get('dashboard', Controllers\DashboardController::class)->name('dashboard');

    Route::post('logout', [Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('logout', [Controllers\AuthController::class, 'logout'])->name('logout');
    
});