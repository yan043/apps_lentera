<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;

Route::post('telegram/lenteraBot', [TelegramController::class, 'lenteraBot']);
