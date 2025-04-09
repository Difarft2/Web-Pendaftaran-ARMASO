<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settingwebs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SettingwebController extends Controller
{
    // Menampilkan data setting
    public function index()
    {
        $settingweb = Settingwebs::first();
        return view('admin.settingweb.index', compact('settingweb'));
    }

    // Menampilkan form edit setting
    public function editSettingweb()
    {
        try {
            $settingweb = Settingwebs::first();

            if (!$settingweb) {
                Alert::error('Error', 'Data pengaturan tidak ditemukan.');
                return redirect()->route('settingweb.index');
            }

            return view('admin.settingweb.edit', compact('settingweb'));
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('settingweb.index');
        }
    }

    // Mengupdate data setting
    public function updateSettingweb(Request $request)
    {
        try {
            $request->validate([
                'nama_website' => 'required|string|max:255',
                'deskripsi_website' => 'required|string|max:255',
                'no_peserta_website' => 'required|string|max:255',
                'pesankontakadmin' => 'required|string|max:255',
                'logo_website' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $settingweb = Settingwebs::first();

            if (!$settingweb) {
                Alert::error('Error', 'Data pengaturan tidak ditemukan.');
                return redirect()->route('settingweb.index');
            }

            $data = $request->only([
                'nama_website',
                'deskripsi_website',
                'no_peserta_website',
                'pesankontakadmin'
            ]);

            // Update logo jika ada file yang diunggah
            if ($request->hasFile('logo_website')) {
                $foto = $request->file('logo_website');
                $filename = time() . '_' . $foto->getClientOriginalName();
                $path = $foto->storeAs('logo_website', $filename, 'public');

                // Hapus logo lama jika ada
                if ($settingweb->logo_website && Storage::disk('public')->exists($settingweb->logo_website)) {
                    Storage::disk('public')->delete($settingweb->logo_website);
                }

                $data['logo_website'] = $path;
            }

            $settingweb->update($data);

            Alert::success('Sukses', 'Pengaturan berhasil diperbarui.');
            return redirect()->route('settingweb.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->route('settingweb.edit')->withInput();
        }
    }
}