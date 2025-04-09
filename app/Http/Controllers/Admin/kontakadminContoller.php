<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\kontakadmin;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class kontakadminContoller extends Admin
{
    // Tampilan utama daftar kontak admin
    public function index()
    {
        $kontakadmin = kontakadmin::all();
        return view('admin.kontakadmin.index', compact('kontakadmin'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        try {
            $kontakadmin = kontakadmin::findOrFail($id);
            return view('admin.kontakadmin.edit', compact('kontakadmin'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Data tidak ditemukan: ' . $e->getMessage());
            return redirect()->route('kontakadmin.index');
        }
    }

    // Update kontak admin
    public function updateKontakadmin(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|numeric',
                'info' => 'required|string|max:255',
            ]);

            $kontakadmin = kontakadmin::findOrFail($id);
            $kontakadmin->nama = $request->nama;
            $kontakadmin->no_hp = $request->no_hp;
            $kontakadmin->info = $request->info;
            $kontakadmin->save();

            Alert::success('Sukses', 'Kontak admin berhasil diperbarui!');
            return redirect()->route('kontakadmin.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui kontak: ' . $e->getMessage());
            return redirect()->route('kontakadmin.edit', $id)->withInput();
        }
    }

    // Hapus kontak admin
    public function hapusKontakadmin($id)
    {
        try {
            $kontakadmin = kontakadmin::findOrFail($id);
            $kontakadmin->delete();

            Alert::success('Sukses', 'Data kontak admin berhasil dihapus!');
            return redirect()->route('kontakadmin.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
            return redirect()->route('kontakadmin.index');
        }
    }

    // Menampilkan form tambah data kontak
    public function create()
    {
        return view('admin.kontakadmin.create');
    }

    // Simpan data kontak admin baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required',
                'info' => 'required|string|max:255',
            ]);

            kontakadmin::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'info' => $request->info,
            ]);

            Alert::success('Sukses', 'Kontak admin berhasil ditambahkan!');
            return redirect()->route('kontakadmin.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
            return redirect()->route('kontakadmin.create')->withInput();
        }
    }
}