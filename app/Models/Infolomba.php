<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infolomba extends Model
{
    use HasFactory;

    protected $table = 'infolombas';
    protected $primaryKey = 'idlomba';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_lomba',
        'harga',
        'deskripsi',
    ];

    // public function tagihan()
    // {
    //     return $this->belongsToMany(Tagihan::class, 'tagihan_mapel', 'mapel_id', 'tagihan_id');
    // }
}
