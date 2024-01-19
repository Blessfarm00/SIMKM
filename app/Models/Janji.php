<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Janji extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'email',
        'tanggal',
        'jam',
        'dokter_id',
        'user_id',
        'keterangan',
        'status',
        'alasan_penolakan',
    ];
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }

}
