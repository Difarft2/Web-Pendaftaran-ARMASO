<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\infoRekening;
use Database\Seeders\settingweb;
use Database\Seeders\modeset;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            infoRekening::class,
            settingweb::class,
            modeset::class,
        ]);
    }
}