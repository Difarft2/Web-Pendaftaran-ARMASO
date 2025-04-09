<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataDiri;
use App\Models\Tagihan;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Jumlah semua pendaftar
        $semuaPendaftar = DataDiri::count();

        // Jumlah pendaftar yang valid
        $pendaftarValid = DataDiri::where('status_data', 'valid')->count();

        // Total semua tagihan
        $semuaTagihan = Tagihan::where('status_tagihan',  'belum_upload')->count();

        // Jumlah pembayaran yang valid
        $pembayaranValid = Tagihan::where('status_tagihan', 'valid')->count();

        $data = DB::table('datadiri')
        ->select('tempat_lahir', DB::raw('count(*) as total'))
        ->groupBy('tempat_lahir')
        ->orderByDesc('total')
        ->get();

        $sekolah = DB::table('datadiri')
        ->select('sekolah', DB::raw('count(*) as total'))
        ->groupBy('sekolah')
        ->orderByDesc('total')
        ->get();


        // Kirim ke view
        return view('admin.dashboardadmin', compact(
            'semuaPendaftar',
            'pendaftarValid',
            'semuaTagihan',
            'pembayaranValid',
            'data',
            'sekolah',
        ));
    }
}
