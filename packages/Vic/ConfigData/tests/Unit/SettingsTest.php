<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use BrainySoft\ConfigData\Models\Customer;
use BrainySoft\ConfigData\Models\Settings;
use BrainySoft\ConfigData\Models\ServiceConfig;
use BrainySoft\ConfigData\Models\DatabaseConfig;

/**
 * Class SettingsTest
 *
 * @package Tests\Feature
 *
 *
 * php  vendor/phpunit/phpunit/phpunit
 * php vendor\phpunit\phpunit\phpunit --verbose packages/Vic/ConfigData/tests/SettingsTest
 *
 */
class SettingsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        //$this->artisan('migrate:fresh', ['--seed' => true,]);
        $this->artisan('db:seed');
    }

    /** @test */
    public function a_customer_has_settings()
    {
//        $settins = factory('App\\Settings')->create();
//        $response = $this->get('/settings');

        $aCustomers = Customer::all();

        $this->assertTrue(count($aCustomers) > 0, "aCastomers = " . gettype($aCustomers) . ' = ' . print_r($aCustomers, true));
        $customer = $aCustomers[0];

        //$this->assertTrue(count($customer->settings) > 0, "settings = " . print_r($customer, true));
        $this->assertTrue(
            count($customer->settings) > 0,
            "customer = " . print_r($customer->getAttributes(), true)
            . "settings = " . print_r($this->modelAttr(Settings::all()->toArray()), true)
            //. "\n\ncustomers = " . print_r($this->modelAttr(Customer::all()->toArray()), true)
        );

//        $response->assertStatus(200);
//        $response->assertSee($settins->{'customer_key'});
    }

    /**
     *
     */
    public function testSettingHasCustomer() {
        $settings = Settings::all();
        $this->assertTrue(count($settings) > 0, "Empty settings data");

        /** @var \BrainySoft\ConfigData\Models\Customer $customer */
        $customer = $settings[0]->customer;
        $this->assertInstanceOf(Customer::class, $customer, "Error customer class: " . print_r($customer, true) . print_r($settings[0], true));

        $serviceConfig = new ServiceConfig($customer->customer_key);
        $this->assertTrue(strlen($serviceConfig->bsauth) > 0, "Error config bsauth: " . print_r($serviceConfig->getAllSettings(), true));

        $dbConfig = new DatabaseConfig($customer->customer_key);
        $this->assertTrue(strlen($dbConfig->database) > 0, "Error config database: " . print_r($dbConfig->getAllSettings(), true));
        $this->assertTrue(substr($dbConfig->database, 0, 3) == 'ln_', "Error config database: " . print_r($dbConfig->getAllSettings(), true));

    }

    /**
     *
     */
    public function testContainer() {
        $customer_key = 'testcustomer';
        $app = $this->createApplication();
        $app->instance('$customer_key', $customer_key);
        /**
         * Формат должен быть такой:
         * $app('customer_key')
         *  - для http берется из headers или routes
         *
         */

    }

    public function modelAttr($models) {
        return array_reduce(
            $models,
            function($carry, $el) {
                /** @var \Illuminate\Database\Eloquent\Model $el */
                $carry[] = $el; // ->getAttributes();
                return $carry;
            },
            []
        );
    }
}
