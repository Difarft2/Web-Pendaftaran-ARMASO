<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persyaratans extends Model
{
    use HasFactory;

    protected  $table = 'persyaratans';

    protected $fillable = [
        'nama_persya',
        'persyaratan',
        'jenis',
        'tanggal',
    ];
}