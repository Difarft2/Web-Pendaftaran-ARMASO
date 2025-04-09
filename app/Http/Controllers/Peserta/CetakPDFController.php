<?php

namespace App\Http\Controllers\Peserta;

use App\Models\DataDiri;
use App\Models\Tagihan;
use App\Models\Settingwebs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Illuminate\Support\Facades\Response;

class CetakPDFController extends Controller
{
    public function cetakKartuPeserta($id)
    {
        $peserta = DataDiri::findOrFail($id);

        // Generate public_token jika kosong
        if (empty($peserta->public_token)) {
            $peserta->public_token = Str::random(32);
            $peserta->save();
        }

        $url = url('/qrc/' . $peserta->public_token);

        $settingweb = Settingwebs::first();
        $logoPath = public_path('storage/' . $settingweb->logo_website);

        // QR code as data URI
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->size(300)
            ->margin(10)
            ->logoPath($logoPath)
            ->logoResizeToWidth(100)
            ->logoResizeToHeight(100)
            ->build();

        $qrCodeBase64 = $result->getDataUri();

        $pdf = Pdf::loadView('pdf.kartuPeserta', compact('peserta', 'qrCodeBase64'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('kartu_peserta_' . $peserta->nomor_peserta . '.pdf');
    }

    public function show($token)
    {
        $peserta = DataDiri::where('public_token', $token)->firstOrFail();
        return view('infopeserta', compact('peserta'));
    }

    public function cetakTagihan($id)
    {
        $tagihan = Tagihan::with('dataDiri')->findOrFail($id);
        $peserta = $tagihan->dataDiri;

        $pdf = Pdf::loadView('pdf.kartuTagihan', compact('tagihan','peserta'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('tagihan_' . $tagihan->nomor_tagihan . '.pdf');
    }
}
