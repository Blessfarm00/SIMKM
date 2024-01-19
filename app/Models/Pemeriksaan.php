<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pemeriksaan',
        'no_antrian',
        'pasien_id',
        'dokter_id',
        'tekanan_darah',
        'suhu_badan',
        'keluhan',
        'status_pemeriksaan',
        'tanggal',
    ];
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
