<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep_obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekam_medis_id',
        'obat_id',
        'jumlah_obat',
        'keterangan',
        'resep_id',
        'harga',
        'total_harga'
    ];

    public function rekam_medis()
    {
        return $this->belongsTo(Rekam_medis::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }    
    
}


