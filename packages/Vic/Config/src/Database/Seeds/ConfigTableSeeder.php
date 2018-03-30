<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.03.2018
 * Time: 14:41
 */
namespace BrainySoft\Config\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/sql/seed_config_data.sql';
        $sql = file_get_contents($path);
        echo "Seed file {$path}\n";
        DB::unprepared($sql);
    }

}