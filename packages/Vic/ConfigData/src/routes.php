<?php

use BrainySoft\ConfigData\Http\Controllers\ConfigController;

Route::resource('config', ConfigController::class);
Route::group([], function () {
//    Route::get('/package/{customer_key}/index', \BrainySoft\ConfigData\Http\Controllers\ConfigDataController::class .'@index');
//    Route::get('/package/{customer_key}/test', function() {
//        /** @var \BrainySoft\ConfigData\Interfaces\CustomerKeyInterface $customerKeyInterface */
//        $customerKeyInterface = App()->make('BrainySoft\ConfigData\Interfaces\CustomerKeyInterface');
//        echo "getCustomerKey = " . $customerKeyInterface->getCustomerKey()
//            . " (" . get_class($customerKeyInterface) . ")\n"
//            . print_r($_SERVER['argv'], true) . "\n";
//
//    });
    // /outside/payment/ConfigData/{customer_name}/check
});
