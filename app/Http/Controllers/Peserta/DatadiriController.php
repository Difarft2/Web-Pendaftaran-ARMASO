<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;
use App\Models\Settingwebs;
use App\Models\Infolomba;
use App\Models\Tagihan;

class DatadiriController extends Controller
{
    public function index()
    {
        $peserta = DataDiri::where('user_id', auth()->id())->first(); // Ambil data peserta sesuai user login
        $infolomba = Infolomba::all();
        $tagihan = $peserta ? Tagihan::where('datadiri_id', $peserta->id)->first() : null;

        return view('peserta.datadiri.index', compact('peserta', 'infolomba', 'tagihan'));
    }


    public function create()
    {
        return view('peserta.datadiri.isidatadiri');
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
            'user_id' => auth()->id(),
            'nomor_peserta' => $newNomorPeserta
        ]));

        return redirect()->route('peserta.datadiri.index')->with('success', 'Data berhasil ditambahkan. Silahkan pilih mapel yang ingin di ikuti');
    }

    public function edit()
    {
        $peserta = Datadiri::where('user_id', auth()->id())->first();
        return view('peserta.datadiri.editdatadiri', compact('peserta'));
    }

    public function update(Request $request)
    {
        $peserta = Datadiri::where('user_id', auth()->id())->first();

        $request->validate([

            'nama_lengkap' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|max:15',

        ]);

        $peserta->update($request->all());

        return redirect()->route('peserta.datadiri.index')->with('success', 'Data berhasil diperbarui.');
    }
}