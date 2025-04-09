<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Tagihan::all()->map(function ($item) {
            return [
                'nomor_tagihan' => $item->nomor_tagihan,
                'total_tagihan' => $item->total_tagihan,
                'status_tagihan' => $item->status_tagihan,
                'nomor_bukti_pembayaran' => $item->nomor_bukti_pembayaran,
                'tanggal_upload' => $item->tanggal_upload,
                'nama' => $item->nama,
                'lomba' => $item->lomba,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Tagihan',
            'Total Tagihan',
            'Status Tagihan',
            'Nomor Bukti Pembayaran',
            'Tanggal Upload',
            'Nama',
            'Lomba',
        ];
    }
}
