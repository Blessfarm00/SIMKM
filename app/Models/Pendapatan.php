<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pendapatan',
        'kode_rekam_medis',
        'pelayanan',
        'harga',
        'tanggal',
        'resep_id',
        'harga_obat',
        'spesialisasi', 
        'harga_spesialisasi',
        'total',
    ];

    public function rekam_medis()
    {
        return $this->belongsTo(Rekam_medis::class, 'kode_rekam_medis','id');
    }

    public function resep_obat()
    {
        return $this->belongsTo(Resep_obat::class, 'resep_id', 'id');
    }
}
