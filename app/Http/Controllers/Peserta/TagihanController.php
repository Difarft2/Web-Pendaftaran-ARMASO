<?php

namespace App\Http\Controllers\Peserta;

use Carbon\Carbon;
use App\Models\Tagihan;
use App\Models\DataDiri;
use App\Models\rekening;
use App\Models\Infolomba;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class TagihanController extends Controller
{
    public function index()
    {
        $rekening = Rekening::all();

        $peserta = DataDiri::where('user_id', auth()->id())->first();

        $tagihan = $peserta ? Tagihan::where('datadiri_id', $peserta->id)->first() : null;

        return view('peserta.tagihan.tagihan', compact('rekening', 'tagihan'));
    }

    public function pilihMapel(Request $request)
    {
         // Validasi input
         $request->validate([
            'mapel' => 'required|array',
            'mapel.*' => 'string'
        ]);

        // Ambil data diri peserta (misalkan berdasarkan user login)
        $dataDiri = datadiri::where('user_id', auth()->id())->first();
        if (!$dataDiri) {
            return back()->with('error', 'Data diri tidak ditemukan.');
        }

        // Buat nomor tagihan dengan format tglbulantahun_nomorpeserta
        $tanggal = Carbon::now()->format('dmY');
        $nomorTagihan = $tanggal . '_' . $dataDiri->nomor_peserta;

        // Ambil harga dari infolomba yang dipilih
        $totalHarga = Infolomba::whereIn('nama_lomba', $request->mapel)->sum('harga');

        // Simpan data ke dalam tagihan
        $tagihan = tagihan::create([
            'datadiri_id' => $dataDiri->id,
            'nomor_tagihan' => $nomorTagihan,
            'total_tagihan' => $totalHarga,
            // 'status_tagihan' => 'di_periksa',
            'nama' => $dataDiri->nama_lengkap, // Nama diambil dari tabel DataDiri
            'lomba' => implode(',', $request->mapel),
            // 'tanggal_upload' => null,
        ]);

        return back()->with('success', 'Data berhasil disimpan! Silahkan Upload Bukti Pembayaran');
    }

    public function uploadBukti(Request $request, $id)
    {
        // Validasi file
    $request->validate([
        'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png|max:2048', // Maksimal 2MB
    ]);

    // Ambil data tagihan berdasarkan ID
    $tagihan = Tagihan::findOrFail($id);

    // Simpan file ke storage
    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/bukti_pembayaran', $filename); // Simpan di storage

        // Hapus bukti lama jika ada
        if ($tagihan->bukti_pembayaran) {
            Storage::delete('public/bukti_pembayaran/' . $tagihan->bukti_pembayaran);
        }

        // Buat nomor bukti pembayaran (contoh: INV-20250326-00123)
        $nomorBukti = date('Ymd') . '-' . str_pad($tagihan->id, 5, '0', STR_PAD_LEFT);

        // Update database dengan file baru dan nomor bukti pembayaran
        $tagihan->bukti_pembayaran = $filename;
        $tagihan->nomor_bukti_pembayaran = $nomorBukti;
        $tagihan->status_tagihan = 'di_periksa';
        $tagihan->tanggal_upload =  $tagihan->tanggal_upload = $tagihan->tanggal_upload ?? now();
        $tagihan->save();
    }

    return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }
}