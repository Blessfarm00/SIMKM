<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanLuka extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_perawatan',
        'nama_pasien',
        'alamat',
        'dokter_id',
        'jenis_luka',
        'status',
        'pengerjaan'
    ];
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
