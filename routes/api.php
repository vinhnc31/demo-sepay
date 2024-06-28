<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SePayController;

Route::group([
    'prefix' => 'api/sepay',
    'as' => 'sepay.',
    // 'middleware' => ['api'],
], function () {
    Route::any('/webhook', [SePayController::class, 'webhook'])->name('webhook');
});