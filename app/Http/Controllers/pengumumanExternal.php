<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengumuman;

class pengumumanExternal extends Controller
{
    public function index()
    {
        $pengumuman = pengumuman::where('jenis', 'eksternal')->get();
        return view('pengumuman', compact('pengumuman'));
    }
}