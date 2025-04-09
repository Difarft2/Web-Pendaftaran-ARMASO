<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settingwebs;
use App\Models\DataDiri;
use App\Models\Infolomba;
use App\Models\Tagihan;

class DaftarofflineController extends Controller
{
    public function index()
    {
        $pesertaOffline = DataDiri::with('tagihan')->where('jenis_daftar', 'ofline')->get();
        $infolomba = Infolomba::all();

        return view('admin.datadiripeserta.ofline.index', compact('pesertaOffline', 'infolomba'));
    }

    public function create()
    {
        return view('admin.datadiripeserta.ofline.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_peserta' => 'string|unique:datadiri',
            'nisn' => 'required|numeric|unique:datadiri',
            'nama_lengkap' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Ambil setting format nomor peserta dari Settingwebs
        $setting = SettingWebs::first();
        $formatNomorPeserta = $setting->no_peserta_website;

        // Ambil nomor peserta terakhir untuk increment
        $lastPeserta = Datadiri::where('nomor_peserta', 'like', $formatNomorPeserta.'%')
                                ->orderBy('nomor_peserta', 'desc')
                                ->first();

        // Ambil angka terakhir dari nomor peserta terakhir
        $lastNumber = $lastPeserta ? (int)substr($lastPeserta->nomor_peserta, strlen($formatNomorPeserta)) : 0;

        // Generate nomor peserta baru dengan increment
        $newNomorPeserta = $formatNomorPeserta . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        // Menambahkan data peserta dengan nomor peserta yang baru
        Datadiri::create(array_merge($request->all(), [
            'nomor_peserta' => $newNomorPeserta,
            'jenis_daftar' => 'ofline',
            'status_data' => 'valid'
        ]));

        return redirect()->route('ofline.index')->with('success', 'Data berhasil ditambahkan. Silahkan pilih mapel ');
    }

    public function pilihMapel(Request $request)
    {
        // Validasi input
        $request->validate([
            'peserta_id' => 'required|exists:datadiri,id', // Pastikan ID peserta valid
            'mapel' => 'required|array',
            'mapel.*' => 'string'
        ]);

        // Ambil data peserta berdasarkan ID
        $dataDiri = datadiri::find($request->peserta_id);
        if (!$dataDiri) {
            return redirect()->back()->with('error', 'Data diri tidak ditemukan.');
        }

        // Buat nomor tagihan dengan format tglbulantahun_nomorpeserta
        $tanggal = \Carbon\Carbon::now()->format('dmY');
        $nomorTagihan = $tanggal . '_' . $dataDiri->nomor_peserta;

        // Ambil harga dari infolomba yang dipilih
        $totalHarga = Infolomba::whereIn('nama_lomba', $request->mapel)->sum('harga');

        // Simpan data ke dalam tagihan
        $tagihan = Tagihan::create([
            'datadiri_id' => $dataDiri->id,
            'nomor_tagihan' => $nomorTagihan,
            'total_tagihan' => $totalHarga,
            'nama' => $dataDiri->nama_lengkap,
            'lomba' => implode(',', $request->mapel),
            'status_tagihan' => 'valid'
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $peserta = DataDiri::findOrFail($id);

        // Hapus semua tagihan terkait
        $peserta->tagihan()->delete();

        // Hapus peserta
        $peserta->delete();

        return redirect()->route('ofline.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('Admin.datadiripeserta.ofline.show', compact('peserta'));
    }

    public function edit($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('Admin.datadiripeserta.ofline.edit', compact('peserta'));
    }

    public function update(Request $request, $id)
    {
        $peserta = DataDiri::findOrFail($id);

        // Validasi input
        $request->validate([
            'nisn' => 'required|numeric|unique:datadiri,nisn,' . $peserta->id,
            'nama_lengkap' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Update data
        $peserta->update($request->all());

        return redirect()->route('ofline.show', $id)->with('success', 'Data berhasil diperbarui.');
    }
}
