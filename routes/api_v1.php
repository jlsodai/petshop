<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response(['status' => 'success', 'api_version' => 1]);
});

/*
 * Auth Routes
 */
Route::group([
    'controller' => AuthController::class,
    'prefix' => 'user',
    'as' => 'user.',
], function() {
    Route::get('/', 'show')->name('show');
    Route::delete('/', 'delete')->name('delete');
    Route::post('create', 'create')->name('create');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});

/*
 * Payment Routes
 */
Route::group([
    'controller' => PaymentController::class,
    'prefix' => 'payments',
    'as' => 'payments.'
], function() {
    Route::get('/', 'index')->name('index');
    Route::post('/create', 'create')->name('create');
    Route::get('/{payment:uuid}', 'show')->name('show');
    Route::put('/{payment:uuid}', 'update')->name('update');
    Route::delete('/{payment:uuid}', 'delete')->name('delete');
});

/*
 * Payment Routes
 */
Route::group([
    'controller' => CurrencyController::class,
    'prefix' => 'currency',
    'as' => 'currency.'
], function() {
    Route::get('/convert', 'convert');
});
