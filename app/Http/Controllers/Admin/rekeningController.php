<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Admin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class rekeningController extends Admin
{
    // Menampilkan data rekening
    public function index()
    {
        $rekening = Rekening::all();
        return view('admin.rekening.index', compact('rekening'));
    }

    // Menampilkan form edit untuk data pertama
    public function editRekening()
    {
        try {
            $rekening = Rekening::first(); // Ambil data pertama
            if (!$rekening) {
                Alert::error('Error', 'Data rekening belum tersedia!');
                return redirect()->route('rekening.index');
            }

            return view('admin.rekening.edit', compact('rekening'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('rekening.index');
        }
    }

    // Mengupdate data informasi pembayaran
    public function updateRekening(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_rekening' => 'required|string|max:255',
                'nama_bank' => 'required|string|max:255',
                'cabang' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
            ]);

            $rekening = Rekening::first(); // Ambil data pertama
            if (!$rekening) {
                Alert::error('Error', 'Data rekening tidak ditemukan!');
                return redirect()->route('rekening.index');
            }

            $rekening->update($request->all());

            Alert::success('Sukses', 'Info pembayaran berhasil diperbarui!');
            return redirect()->route('rekening.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('rekening.edit')->withInput();
        }
    }
}