<?php

namespace BrainySoft\Config;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;
use BrainySoft\ConfigData\Services\RequestCustomerKey;
use BrainySoft\ConfigData\Services\CliCustomerKey;


/**
 * Class ConfigServiceProvider
 * @package BrainySoft\ConfigData
 *
 * php artisan migrate:fresh --seed
 *
 */
class ConfigServiceProvider extends ServiceProvider
{



    /**
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        if( env('APP_ENV', '') == 'testing' ) {
            $seedsDir = base_path() . '/database/seeds/sql';
            $seedsSrc = __DIR__ . '/Database/Seeds/seed_config_data.sql';
            $seedsDest = $seedsDir . '/seed_config_data.sql';

            if( !file_exists($seedsDir) ) {
                mkdir($seedsDir);
            }

            if( !file_exists($seedsDest) || (filemtime($seedsDest) < filemtime($seedsSrc)) ) {
                copy($seedsSrc, $seedsDest);
            }
        }
//        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     *
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(__DIR__.'/config/configdata.php', 'configdata');
        include __DIR__ . '/routes.php';

    }
}