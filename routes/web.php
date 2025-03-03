<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;

Route::get('/welcome', fn() => view('additionals.welcome'));
Route::get('/layouts', fn() => view('layouts.general'));
Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('settings')->name('settings.')->middleware('role:Developer')->group(function () {
        Route::get('regional', [SettingsController::class, 'regional'])->name('regional');
        Route::post('regional/store', [SettingsController::class, 'regional_store'])->name('regional.store');
        Route::get('regional/{id}', [SettingsController::class, 'regional_destroy'])->name('regional.destroy');

        Route::get('witel', [SettingsController::class, 'witel'])->name('witel');
        Route::post('witel/store', [SettingsController::class, 'witel_store'])->name('witel.store');
        Route::get('witel/{id}', [SettingsController::class, 'witel_destroy'])->name('witel.destroy');

        Route::get('mitra', [SettingsController::class, 'mitra'])->name('mitra');
        Route::post('mitra/store', [SettingsController::class, 'mitra_store'])->name('mitra.store');
        Route::get('mitra/{id}', [SettingsController::class, 'mitra_destroy'])->name('mitra.destroy');

        Route::get('level', [SettingsController::class, 'level'])->name('level');
        Route::post('level/store', [SettingsController::class, 'level_store'])->name('level.store');
        Route::get('level/{id}', [SettingsController::class, 'level_destroy'])->name('level.destroy');
    });

});
