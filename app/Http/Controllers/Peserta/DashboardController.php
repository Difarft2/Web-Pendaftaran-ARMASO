<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\DataDiri;
use App\Models\Tagihan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil pengumuman internal
        $pengumuman = Pengumuman::where('jenis', 'internal')->orderBy('tanggal', 'desc')->get();

        // Ambil data peserta
        $peserta = DataDiri::where('user_id', auth()->id())->first();

        // Jika $peserta null, jangan lanjutkan mencari tagihan
        $tagihan = $peserta ? Tagihan::where('datadiri_id', $peserta->id)->first() : null;

        return view('peserta.dashboardPeserta', compact('pengumuman', 'peserta', 'tagihan'));
    }
}