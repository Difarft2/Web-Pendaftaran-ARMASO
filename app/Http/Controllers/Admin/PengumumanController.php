<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
    // Menampilkan halaman tambah pengumuman
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // Menyimpan data pengumuman ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'jenis' => 'required|in:internal,eksternal',
                'isi' => 'required',
            ]);

            Pengumuman::create([
                'judul' => $request->judul,
                'jenis' => $request->jenis,
                'isi' => $request->isi,
            ]);

            // SweetAlert sukses
            Alert::success('Sukses', 'Pengumuman berhasil ditambahkan!');
            return redirect()->route('pengumuman.index');
        } catch (\Exception $e) {
            // SweetAlert error
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan pengumuman: ' . $e->getMessage());
            return redirect()->route('pengumuman.create')->withInput();
        }
    }

    // Menampilkan semua pengumuman
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    // Menampilkan halaman edit pengumuman
    public function edit($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail($id);
            return view('admin.pengumuman.edit', compact('pengumuman'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Pengumuman tidak ditemukan: ' . $e->getMessage());
            return redirect()->route('pengumuman.index');
        }
    }

    // Mengupdate data pengumuman
    public function updatePengumuman(Request $request, $id)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'isi' => 'required',
                'jenis' => 'required|in:internal,eksternal',
            ]);

            $pengumuman = Pengumuman::findOrFail($id);
            $pengumuman->judul = $request->judul;
            $pengumuman->isi = $request->isi;
            $pengumuman->jenis = $request->jenis;
            $pengumuman->save();

            Alert::success('Sukses', 'Pengumuman berhasil diperbarui!');
            return redirect()->route('pengumuman.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate pengumuman: ' . $e->getMessage());
            return redirect()->route('pengumuman.edit', $id)->withInput();
        }
    }

    // Menghapus data pengumuman
    public function hapusPengumuman($id)
    {
        try {
            $pengumuman = Pengumuman::findOrFail($id);
            $pengumuman->delete();

            Alert::success('Sukses', 'Pengumuman berhasil dihapus!');
            return redirect()->route('pengumuman.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus pengumuman: ' . $e->getMessage());
            return redirect()->route('pengumuman.index');
        }
    }
}