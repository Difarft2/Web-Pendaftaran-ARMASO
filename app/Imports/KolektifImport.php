<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\SettingWebs;
use App\Models\DataDiri;
use App\Models\Tagihan;
use App\Models\Infolomba;
use Illuminate\Support\Facades\Log;

class KolektifImport implements ToCollection
{
    protected $request;
    public $total = 0;
    public $berhasil = 0;
    public $gagal = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection(Collection $rows)
    {
        $setting = SettingWebs::first();
        $formatNomorPeserta = $setting ? $setting->no_peserta_website : 'ARMASO25';

        $lastPeserta = DataDiri::where('nomor_peserta', 'like', $formatNomorPeserta . '%')
            ->orderBy('nomor_peserta', 'desc')
            ->first();

        $lastNumber = $lastPeserta
            ? (int)substr($lastPeserta->nomor_peserta, strlen($formatNomorPeserta))
            : 0;

        $currentNumber = $lastNumber;

        foreach ($rows as $index => $row) {
            $nama = $row['nama_lengkap'] ?? 'Tanpa Nama';
            // Abaikan baris kosong (semua kolom kosong atau hanya spasi)
            if ($index === 0 || $row->filter(function ($cell) {
                return trim($cell) !== '';
            })->isEmpty()) {
                continue;
            }

            try {
                $nisn = trim((string)$row[0]);
                $nama = trim((string)$row[1]);
                $nomorHp = trim((string)$row[7]);
                $mapel = trim((string)$row[8]);

                if (empty($nisn) || empty($nama) || empty($nomorHp) || empty($mapel)) {
                    $this->gagal[] = $nama ?: 'Tanpa Nama (Data Tidak Lengkap)';
                    continue;
                }

                // Cek duplikasi NISN
                if (DataDiri::where('nisn', $nisn)->exists()) {
                    $this->gagal[] = $nama . ' (NISN Duplikat)';
                    continue;
                }

                $this->total++;
                $currentNumber++;
                $nomorPeserta = $formatNomorPeserta . str_pad($currentNumber, 4, '0', STR_PAD_LEFT);

                $tanggalLahir = null;
                if (is_numeric($row[4])) {
                    $tanggalLahir = Date::excelToDateTimeObject(trim($row[4]))->format('Y-m-d');
                } else {
                    $tanggalLahir = date('Y-m-d', strtotime(trim($row[4])));
                }

                $jenisKelamin = strtolower(trim($row[5])) === 'laki-laki' ? 'Laki-laki' : 'Perempuan';
                $nomorHp = preg_replace('/[^0-9]/', '', $nomorHp);
                $mapelSiswa = array_map('trim', explode(',', $mapel));
                $hargaSiswa = Infolomba::whereIn('nama_lomba', $mapelSiswa)->sum('harga');

                $dataDiri = DataDiri::create([
                    'nomor_peserta' => $nomorPeserta,
                    'nisn' => $nisn,
                    'nama_lengkap' => $nama,
                    'sekolah' => trim($row[2]),
                    'tempat_lahir' => trim($row[3]),
                    'tanggal_lahir' => $tanggalLahir,
                    'jenis_kelamin' => $jenisKelamin,
                    'alamat' => trim($row[6]),
                    'nomor_hp' => $nomorHp,
                    'status_data' => 'valid',
                    'jenis_daftar' => 'kolektif',
                ]);

                $nomorTagihan = now()->format('dmY') . '_' . $nomorPeserta;

                Tagihan::create([
                    'datadiri_id' => $dataDiri->id,
                    'nomor_tagihan' => $nomorTagihan,
                    'lomba' => implode(', ', $mapelSiswa),
                    'status_tagihan' => 'valid',
                    'bukti_pembayaran' => null,
                    'nomor_bukti_pembayaran' => null,
                    'tanggal_upload' => null,
                    'nama' => $dataDiri->nama_lengkap,
                    'total_tagihan' => $hargaSiswa,
                ]);

                $this->berhasil++;
            } catch (\Exception $e) {
                Log::error("Gagal import baris {$index}: " . $e->getMessage());
                $this->gagal[] = $nama ?: 'Tanpa Nama (Error Simpan)';
                continue;
            }
        }
    }

    public function getTotal() { return $this->total; }
    public function getBerhasil() { return $this->berhasil; }
    public function getGagal() { return $this->gagal; }
}