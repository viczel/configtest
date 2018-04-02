<?php

use BrainySoft\Config\Http\Controllers\ConfigController;

Route::get('testblock/customers', ConfigController::class . "@customerList");
Route::get('testblock/customers/{customer_key}', ConfigController::class . "@customerSettings");

//Route::get('exportoldconfig', ConfigController::class . "@export");

//Route::resource('config', ConfigController::class);
