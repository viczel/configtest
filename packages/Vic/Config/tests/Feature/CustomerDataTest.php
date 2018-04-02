<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use BrainySoft\Config\Models\Mfo;

/**
 * Class CustomerDataTest
 *
 * @package Tests\Feature
 *
 *
 * php vendor\phpunit\phpunit\phpunit --verbose packages/Vic/Config/tests/Feature/CustomerDataTest.php
 *
 */

class CustomerDataTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->artisan('db:seed');
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCustomersList()
    {
        $customerKey = 'fastmoney';

        /** @var \BrainySoft\Config\Models\Mfo $mfoModel */
        $mfoModel = Mfo::firstOrFail();
        // where('name', $customerKey)
        $url = "/testblock/customers";

        $this->get($url)
            ->assertSee($mfoModel->name, "No customer key on customer list")
            ->assertSee($mfoModel->title, "No customer title on customer list");

        //$this->assertTrue(true);
    }

    /**
     *
     * @return void
     */
    public function testCustomerSettingsList()
    {

        /** @var \BrainySoft\Config\Models\Mfo $mfoModel */
        $mfoModel = Mfo::with('settings')->firstOrFail();
        $settings = $mfoModel->settings;
        /** @var \BrainySoft\Config\Models\Configs $oneSetting */
        $oneSetting = $settings->first();


        $url = $mfoModel->getSettingPageUrl();

        $this->get($url)
            ->assertSee($mfoModel->name, "No customer key on customer settings page")
            ->assertSee($mfoModel->title, "No customer title on customer settings page")
            ->assertSee($oneSetting->key, "No setting key on customer settings page");


        //$this->assertTrue(true);
    }
}
