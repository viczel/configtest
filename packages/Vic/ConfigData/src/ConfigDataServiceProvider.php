<?php

namespace BrainySoft\ConfigData;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use BrainySoft\ConfigData\Interfaces\CustomerKeyInterface;
use BrainySoft\ConfigData\Services\RequestCustomerKey;
use BrainySoft\ConfigData\Services\CliCustomerKey;


/**
 * Class ConfigDataServiceProvider
 * @package BrainySoft\ConfigData
 *
 * php artisan migrate:fresh --seed
 *
 */
class ConfigDataServiceProvider extends ServiceProvider
{



    /**
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
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

        if (php_sapi_name() == "cli") {
            // command line mode
            $this->app->singleton(
                'BrainySoft\ConfigData\Interfaces\CustomerKeyInterface',
                function($app) {
                    return new CliCustomerKey();
                }
            );
        } else {
            $this->app->singleton(
                'BrainySoft\ConfigData\Interfaces\CustomerKeyInterface',
                function($app) {
                    return new RequestCustomerKey();
                }
            );
        }
    }
}