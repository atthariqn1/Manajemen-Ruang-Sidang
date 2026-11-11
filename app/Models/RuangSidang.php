<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangSidang extends Model
{
    protected $fillable = [
        'kode_ruang',
        'gedung',
        'kapasitas',
        'fasilitas',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'kapasitas' => 'integer',
            'fasilitas' => 'array',
        ];
    }
}
