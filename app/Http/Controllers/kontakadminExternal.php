<?php

namespace App\Http\Controllers;

use App\Models\kontakadmin;
use Illuminate\Http\Request;
use App\Models\Settingwebs;

class kontakadminExternal extends Controller
{
    public function index()
    {
        $setting = Settingwebs::first();
        $pesanmasuk = $setting ? $setting->pesankontakadmin : 'Halo, Selamat datang di website kami!';

        // Encode pesan agar bisa digunakan dalam URL WhatsApp
        $pesan = urlencode($pesanmasuk);
        $kontakadmin = kontakadmin::all();

        return view('kontakadmin', compact('kontakadmin', 'pesan'));
    }
}