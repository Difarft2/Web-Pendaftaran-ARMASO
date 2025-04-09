<?php

namespace App\Http\Controllers;

use App\Models\persyaratans;
use Illuminate\Http\Request;

class persyaratanExternal extends Controller
{
    public function index()
    {
        $persyaratan = persyaratans::where('jenis', 'eksternal')->get();
        return view('persyaratan', compact('persyaratan'));
    }
}