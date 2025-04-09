<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    use HasFactory;

    protected $table = 'datadiri';

    protected $fillable = [
        'nomor_peserta',
        'nisn',
        'nama_lengkap',
        'sekolah',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_hp',
        'status_data',
        'jenis_daftar',
        'user_id',
        'public_token'
    ];

    /**
     * Relasi ke User.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'datadiri_id');
    }
}
