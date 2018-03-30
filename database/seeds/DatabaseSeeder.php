<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Конвертируем MySql dump:
        // "c:\Program Files\Git\usr\bin\awk.exe" -f mysql2sqlite setting-20180330.sql > setting-sqlite-20180330.sql
        // Кладем его в пакете в папку: /Database/Seeds/seed_config_data.sql
        // ServiceProvider его копирует в папку database/seeds/sql


        echo "Seeds\n";
        // $this->call(UsersTableSeeder::class);
//        if( env('APP_ENV', '') == 'testing' ) {
            $this->call(\BrainySoft\Config\Database\Seeds\ConfigTableSeeder::class);
//            $this->call(ConfigTableSeeder::class);
//        }
    }
}
