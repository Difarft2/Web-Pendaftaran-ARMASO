<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class pengumumanExternal extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::where('jenis', 'eksternal')->get();
        return view('pengumuman', compact('pengumuman'));
    }
}