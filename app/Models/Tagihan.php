<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;


    protected $table = 'tagihan';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'datadiri_id',
        'nomor_tagihan',
        'total_tagihan',
        'status_tagihan',
        'bukti_pembayaran',
        'nomor_bukti_pembayaran',
        'tanggal_upload',
        'nama',
        'lomba',
    ];

    // Relasi dengan DataDiri
    public function dataDiri()
    {
        return $this->belongsTo(DataDiri::class, 'datadiri_id');
    }

    public function peserta()
    {
        return $this->belongsTo(DataDiri::class, 'datadiri_id');
    }
}
