<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TagihanMapel extends Pivot
{
    use HasFactory;

    protected $fillable = ['tagihan_id', 'idlomba'];
}
