<?php

namespace App\Http\Controllers;

use App\Models\kontakadmin;
use Illuminate\Http\Request;
use App\Models\SettingWebs;

class kontakadminExternal extends Controller
{
    public function index()
    {
        $setting = SettingWebs::first();
        $pesanmasuk = $setting ? $setting->pesankontakadmin : 'Halo, Selamat datang di website kami!';

        // Encode pesan agar bisa digunakan dalam URL WhatsApp
        $pesan = urlencode($pesanmasuk);
        $kontakadmin = KontakAdmin::all();

        return view('kontakadmin', compact('kontakadmin', 'pesan'));
    }
}