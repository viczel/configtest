<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.03.2018
 * Time: 14:11
 */
namespace BrainySoft\Config\Http\Controllers;

use App\Http\Controllers\Controller;

class ConfigController extends Controller
{

    public function testkeys($customer_key) {
        $baseConfig = new BaseServiceConfig($customer_key, ['IP', 'host', 'database', 'runabank_privatekey_path', ]);
        return $baseConfig->selectTableData();
        return $baseConfig->getAllSettings();
    }


}