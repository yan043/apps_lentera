<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;

Route::post('telegram/lenteraBot', [TelegramController::class, 'lenteraBot']);
