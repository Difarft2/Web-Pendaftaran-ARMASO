<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanPeserta extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::where('status_tagihan', 'belum_upload')->get();

        return view("admin.tagihan.index", compact('tagihan'));
    }

    public function destroy($id)
    {
        // Hapus data peserta berdasarkan ID
        Tagihan::destroy($id);

        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil dihapus.');
    }
}