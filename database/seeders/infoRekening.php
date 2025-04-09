<?php

namespace Database\Seeders;

use App\Models\rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class infoRekening extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        rekening::create([
            'nama' => 'nama',
            'no_rekening' => '9876545678',
            'nama_bank' => 'Bank Rakyat Indonesia (BRI)',
            'cabang' => 'Bojonegoro',
            'deskripsi' => 'Informasi pembayaran untuk transaksi resmi.',
        ]);
    }
}