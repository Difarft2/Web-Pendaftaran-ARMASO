<?php

namespace Database\Seeders;

use App\Models\Settingwebs;
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
        Settingwebs::create([
            'nama_website' => 'website',
            'deskripsi_website' => 'website',
            'no_peserta_website' => 'website',
            'logo_website' => 'website',
        ]);
    }
}
