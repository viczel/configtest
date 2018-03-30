<?php

use BrainySoft\Config\Http\Controllers\ConfigController;

Route::get('exportoldconfig', ConfigController::class . "@export");
Route::get('testblock/{customer_key}/testkeys', ConfigController::class . "@testkeys");

//Route::resource('config', ConfigController::class);
