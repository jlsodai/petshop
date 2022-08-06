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
 * Orders Routes
 */
Route::group([
    'controller' => OrderController::class,
    'as' => 'orders.'
], function() {
    Route::get('/orders', 'index')->name('index');
    Route::get('/orders/dashboard', 'dashboard')->name('dashboard');
    Route::get('/orders/shipment-locator', 'shipmentLocator')->name('shipmentLocator');
    Route::post('/order/create', 'create')->name('create');
    Route::get('/order/{order:uuid}', 'show')->name('show');
    Route::put('/order/{order:uuid}', 'update')->name('update');
    Route::delete('/order/{order:uuid}', 'delete')->name('delete');
    Route::get('/order/{order:uuid}/download', 'download')->name('download');
    Route::get('/order/{order:uuid}/payment', 'payment')->name('payment');
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
