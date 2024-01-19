<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'merek_obat',
        'masa_berlaku',
        'stock',
        'harga',
        'satuan',
    ];
}