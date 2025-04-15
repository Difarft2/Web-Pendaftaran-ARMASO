<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiri;
use App\Models\Tagihan;
use App\Models\Infolomba;

class DatadiripesertaController extends Controller
{
    //daftar online
    public function index()
    {
        $pesertaOnline =DataDiri::with('tagihan')->where('jenis_daftar', 'online')->get();

        return view('admin.datadiripeserta.online.index', compact('pesertaOnline'));
    }

    public function switchValidasi($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = Datadiri::findOrFail($id);

        // Toggle status validasi (valid / belum valid)
        $peserta->status_data = $peserta->status_data === 'valid' ? 'belum_valid' : 'valid';
        $peserta->save();

        // Kembalikan response JSON untuk AJAX
        return response()->json(['success' => true, 'status' => $peserta->status_data]);
    }

    public function show($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('admin.datadiripeserta.online.show', compact('peserta'));
    }

    public function edit($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('admin.datadiripeserta.online.edit', compact('peserta'));
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

        return redirect()->route('online.show', $id)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peserta = DataDiri::findOrFail($id);

        // Hapus semua tagihan terkait
        $peserta->tagihan()->delete();

        // Hapus peserta
        $peserta->delete();

        return redirect()->route('online.index')->with('success', 'Data berhasil dihapus.');
    }


    public function semuaData()
    {
        $dataValid = DataDiri::with('tagihan')
            ->where('status_data', 'valid')
            ->get();

        $dataTidakvalid = DataDiri::with('tagihan')
            ->where('status_data', 'belum_valid')
            ->get();

        $infolombas = Infolomba::all();

        return view('admin.datadiripeserta.index', compact('dataValid', 'dataTidakvalid', 'infolombas'));
    }
}
