<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\KolektifImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataDiri;
use App\Models\Infolomba;

class ImportdatakolektifController extends Controller
{
    public function importExcelkolektif(Request $request)
    {
        $import = new KolektifImport($request);
        Excel::import($import, $request->file('file'));
    
        return back()->with('hasil_import', [
            'total' => $import->total,
            'berhasil' => $import->berhasil,
            'gagal' => count($import->gagal),
            'gagal_nama' => $import->gagal,
        ]);
    }

    public  function index()
    {
        $pesertaKolektif = DataDiri::with('tagihan')->where('jenis_daftar', 'kolektif')->get();
        $infolomba = Infolomba::all();

        return view('admin.datadiripeserta.kolektif.index', compact('pesertaKolektif', 'infolomba'));
    }

    public function destroy($id)
    {
        $peserta = DataDiri::findOrFail($id);

        // Hapus semua tagihan terkait
        $peserta->tagihan()->delete();

        // Hapus peserta
        $peserta->delete();

        return redirect()->route('kolektif.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('Admin.datadiripeserta.kolektif.show', compact('peserta'));
    }

    public function edit($id)
    {
        // Ambil data peserta berdasarkan ID
        $peserta = DataDiri::findOrFail($id);

        return view('Admin.datadiripeserta.kolektif.edit', compact('peserta'));
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

        return redirect()->route('kolektif.show', $id)->with('success', 'Data berhasil diperbarui.');
    }
}