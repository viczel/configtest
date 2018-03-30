<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

use BrainySoft\Config\Models\Mfo;


/**
 * Class SettingsTest
 *
 * @package Tests\Feature
 *
 *
 * php  vendor/phpunit/phpunit/phpunit
 * php vendor\phpunit\phpunit\phpunit --verbose packages/Vic/Config/tests/Unit/SettingsTest
 *
 */
class SettingsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function a_customer_has_settings()
    {
        $customerKey = 'fastmoney';
        /** @var \BrainySoft\Config\Models\Mfo $mfo */
        $mfo = Mfo::where('name', $customerKey)->get()->first();
        $this->assertTrue($mfo->name == $customerKey, "Config Customer name error: {$mfo->name}");
    }

    /**
     *
     */
//    public function testSettingHasCustomer() {
//
//    }

}
