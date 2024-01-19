<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunat extends Model
{
    protected $fillable = [
        'kode_sunat',
        'nama_pasien',
        'alamat',
        'dokter_id',
        'umur',
        'tanggal',
        'keterangan',
    ];
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
