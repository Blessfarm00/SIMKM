<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengeluaran',
        'obat_id',
        'jumlah',
        'keterangan',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

}
