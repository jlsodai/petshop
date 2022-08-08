<?php

use Illuminate\Support\Facades\Route;
use Julius\CurrencyConvert\Http\Controllers\CurrencyController;

Route::group([
    'controller' => CurrencyController::class,
    'prefix' => 'api/currency-convert',
], function() {
    Route::get('/convert', 'convert');
});
