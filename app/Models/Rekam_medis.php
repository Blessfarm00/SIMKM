<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekam_medis extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_rekam_medis',
        'pemeriksaan_id',
        'pasien_id',
        'diagnosa',
        'tindakan',
        'rujukan',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

}
