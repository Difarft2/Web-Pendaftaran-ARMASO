<?php


namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KontakAdmin;
use App\Models\SettingWebs;
use App\Models\persyaratans;

class kontakdansyaratController extends Controller
{
    public function kontakadmin()
    {
        $setting = SettingWebs::first();
        $pesanmasuk = $setting ? $setting->pesankontakadmin : 'Halo, Selamat datang di website kami!';

        // Encode pesan agar bisa digunakan dalam URL WhatsApp
        $pesan = urlencode($pesanmasuk);
        $kontakadmin = KontakAdmin::all();

        return view('peserta.kontakadmin', compact('kontakadmin', 'pesan'));
    }

    public function syarat()
    {
        $syarat = persyaratans::where('jenis', 'internal')->orderBy('tanggal', 'desc')->get();
        return view('peserta.persyaratan', compact('syarat'));
        // return view('peserta.persyaratan');
    }
}