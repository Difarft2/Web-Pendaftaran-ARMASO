<?php
namespace App\Exports;

use App\Models\DataDiri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataDiri::with('tagihan')
            ->get()
            ->map(function ($item) {
                return [
                    'nomor_peserta' => $item->nomor_peserta,
                    'nisn' => $item->nisn,
                    'nama_lengkap' => $item->nama_lengkap,
                    'sekolah' => $item->sekolah,
                    'tempat_lahir' => $item->tempat_lahir,
                    'tanggal_lahir' => $item->tanggal_lahir,
                    'jenis_kelamin' => $item->jenis_kelamin,
                    'alamat' => $item->alamat,
                    'nomor_hp' => $item->nomor_hp,
                    'status_data' => $item->status_data,
                    'jenis_daftar' => $item->jenis_daftar,
                    'lomba' => $item->tagihan->lomba ?? '-', // relasi ke tagihan
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nomor Peserta',
            'NISN',
            'Nama Lengkap',
            'Sekolah',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            'Nomor HP',
            'Status Data',
            'Jenis Daftar',
            'Lomba',
        ];
    }
}
