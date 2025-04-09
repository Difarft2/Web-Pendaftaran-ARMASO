<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Infolomba;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new DataExport, 'data_peserta.xlsx');
    }

    public function exportTagihan(Request $request)
    {
        return Excel::download(new \App\Exports\TagihanExport, 'tagihandanpembayaran_peserta.xlsx');
    }
}
