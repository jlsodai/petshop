<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response(['status' => 'success', 'api_version' => 1]);
});

Route::group(['namespace' => 'App\Http\Controllers\Api\V1'], function() {
    /*
     * Auth Routes
     */
    Route::controller(AuthController::class)->prefix('user')->as('v1.user.')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::delete('/', 'delete')->name('delete');
        Route::post('create', 'create')->name('create');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });
});
