<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settingwebs extends Model
{
    use HasFactory;

    protected $tabel = 'Settingwebs';

    protected $fillable = [
        'nama_website',
        'deskripsi_website',
        'no_peserta_website',
        'logo_website',
        'pesankontakadmin',
    ];
}