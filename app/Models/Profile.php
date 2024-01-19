<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama_user',
        'gambar_user',
        'gambar_dokter',
        'no_hp',
        'posisi',
        'role',
    ];

    
}
