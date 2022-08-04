<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response(['status' => 'success', 'api_version' => 1]);
});
