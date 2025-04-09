<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\persyaratans;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class persyaratanController extends Controller
{
    // Menampilkan persyaratan
    public function index()
    {
        $persyaratan = persyaratans::all();
        return view('admin.persyaratan.index', compact('persyaratan'));
    }

    // Menampilkan tambah data
    public function create()
    {
        return view('admin.persyaratan.create');
    }

    // Menyimpan data
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_persya' => 'required|string|max:255',
                'jenis' => 'required|in:internal,eksternal',
                'persyaratan' => 'required',
            ]);

            persyaratans::create([
                'nama_persya' => $request->nama_persya,
                'jenis' => $request->jenis,
                'persyaratan' => $request->persyaratan,
            ]);

            // Menampilkan SweetAlert sukses
            Alert::success('Sukses', 'Persyaratan telah disimpan!');

            // Redirect ke halaman index
            return redirect()->route('persyaratan.index');
        } catch (\Exception $e) {
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan persyaratan: ' . $e->getMessage());

            // Redirect kembali ke halaman form tambah
            return redirect()->route('persyaratan.create')->withInput();
        }
    }

    // Menampilkan edit data
    public function edit($id)
    {
        try {
            $persyaratan = persyaratans::findOrFail($id); // Jika tidak ditemukan, akan melempar exception
            return view('admin.persyaratan.edit', compact('persyaratan'));
        } catch (\Exception $e) {
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Persyaratan tidak ditemukan: ' . $e->getMessage());
            return redirect()->route('persyaratan.index');
        }
    }

    // Menyimpan perubahan data
    public function updatesyarat(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_persya' => 'required|string|max:255',
                'jenis' => 'required|in:internal,eksternal',
                'persyaratan' => 'required',
            ]);

            $persyaratan = persyaratans::findOrFail($id); // Jika tidak ditemukan, akan melempar exception
            $persyaratan->nama_persya = $request->nama_persya;
            $persyaratan->jenis = $request->jenis;
            $persyaratan->persyaratan = $request->persyaratan;
            $persyaratan->save();

            // Menampilkan SweetAlert sukses
            Alert::success('Sukses!', 'Persyaratan berhasil diperbarui.');

            // Redirect kembali ke halaman index
            return redirect()->route('persyaratan.index');
        } catch (\Exception $e) {
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui persyaratan: ' . $e->getMessage());

            // Redirect kembali ke halaman edit dengan input yang sudah diisi
            return redirect()->route('persyaratan.edit', $id)->withInput();
        }
    }

    // Menghapus data
    public function hapus($id)
    {
        try {
            $persyaratan = persyaratans::findOrFail($id); // Jika tidak ditemukan, akan melempar exception
            $persyaratan->delete();

            // Menampilkan SweetAlert sukses
            Alert::success('Sukses!', 'Persyaratan berhasil dihapus.');

            // Redirect kembali ke halaman index
            return redirect()->route('persyaratan.index');
        } catch (\Exception $e) {
            // Menampilkan SweetAlert error jika terjadi kesalahan
            Alert::error('Error', 'Terjadi kesalahan saat menghapus persyaratan: ' . $e->getMessage());

            // Redirect kembali ke halaman index
            return redirect()->route('persyaratan.index');
        }
    }
}