<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class PembayaranpesertaController extends Controller
{
    public function index()
    {
        $valid = Tagihan::where('status_tagihan', 'valid')->get();

        $belumvalid = Tagihan::where('status_tagihan', 'di_periksa')->get();

        return view('admin.pembayaran.index', compact('valid','belumvalid'));
    }

    public function validbukti($id)
    {
        $data = Tagihan::findOrFail($id);

        $data->status_tagihan = $data->status_tagihan == 'valid' ? 'di_periksa' : 'valid' ;
        $data->save();

        return response()->json(['success' => true, 'status'=> $data->status_tagihan]);
    }
}