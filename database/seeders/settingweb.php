<?php

namespace Database\Seeders;

use App\Models\settingwebs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class settingweb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settingwebs::create([
            'nama_website' => 'website',
            'deskripsi_website' => 'website',
            'no_peserta_website' => 'website',
            'logo_website' => 'website',
        ]);
    }
}
