<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_pasien',
        'umur_pasien',
        'alamat',
        'jenis_kelamin',
        'tgl',
    ];

    public function rekam_medis()
    {
        return $this->belongsTo(Rekam_medis::class);
    }
    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }



}
