<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;
    
    protected $table = 'laporan';

    protected $fillable = [
        'gedung',
        'kwh',
        'tanggal',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];
}
