<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Infolomba;
use RealRashid\SweetAlert\Facades\Alert;

class InfolombaController extends Controller
{
    public function index()
    {
        $infolomba = Infolomba::all();
        return view('admin.infolomba.index', compact('infolomba'));
    }

    public function create()
    {
        return view('admin.infolomba.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama_lomba' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required',
            ]);

            $infolomba = new Infolomba();
            $infolomba->nama_lomba = $request->nama_lomba;
            $infolomba->deskripsi = $request->deskripsi;
            $infolomba->harga = $request->harga;
            $infolomba->save();

            Alert::success('Sukses', 'Data lomba telah disimpan!');
            return redirect()->route('infolomba.index');
        }  catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data lomba: ' . $e->getMessage());
            return redirect()->route('infolomba.create')->withInput();
        }
    }

    public function edit($idlomba)
    {
        $infolomba = Infolomba::find($idlomba);
        return view('admin.infolomba.edit', compact('infolomba'));
    }

    public function update(Request $request, $idlomba)
    {
        try{
            $request->validate([
                'nama_lomba' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required',
            ]);

            $infolomba = Infolomba::find($idlomba);
            $infolomba->nama_lomba = $request->nama_lomba;
            $infolomba->deskripsi = $request->deskripsi;
            $infolomba->harga = $request->harga;
            $infolomba->save();

            Alert::success('Sukses', 'Data lomba telah diupdate!');
            return redirect()->route('infolomba.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat mengupdate data lomba: ' . $e->getMessage());
            return redirect()->route('infolomba.edit', $idlomba)->withInput();
        }
    }

    public function destroy($idlomba)
    {
        try{
            $infolomba = Infolomba::find($idlomba);
            $infolomba->delete();

            Alert::success('Sukses', 'Data lomba telah dihapus!');
            return redirect()->route('infolomba.index');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data lomba: ' . $e->getMessage());
            return redirect()->route('infolomba.index');
        }
    }
}
