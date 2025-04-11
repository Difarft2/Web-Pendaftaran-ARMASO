<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    protected $table = 'mode'; // pastikan pakai nama tabel yang sesuai

    protected $fillable = ['key', 'value'];

    public $timestamps = false;

    public static function getValue($key)
    {
        return static::where('key', $key)->value('value');
    }

    public static function setValue($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}