<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dokter extends Authenticatable
{
    use HasFactory;
    protected $guard = 'dokter';

    protected $fillable = [
        'nama_dokter',
        'gambar_dokter',
        'jenis_kelamin',
        'umur',
        'role',
        'no_hp',
        'email',
        'password',
    ];
}

