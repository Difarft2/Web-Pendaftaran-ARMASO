<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontakadmin extends Model
{
    use HasFactory;
    protected $table = 'kontakadmin';

    protected $fillable = [
        'nama',
        'no_hp',
        'info',
    ];
}
