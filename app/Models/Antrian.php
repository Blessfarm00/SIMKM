<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;
    protected $fillable = ['nomor'];

    // Metode untuk mengambil antrian
    public static function ambilAntrian()
    {
        $antrianTerakhir = self::latest()->first();

        if (!$antrianTerakhir) {
            $nomorAntrian = 1;
        } else {
            $nomorAntrian = $antrianTerakhir->nomor + 1;
        }

        self::create([
            'nomor' => $nomorAntrian,
        ]);
    }

    // Metode untuk mereset otomatis per hari
    public static function resetOtomatis()
    {
        self::truncate();
    }

    // Metode untuk mendapatkan informasi antrian terakhir
    public static function antrianTerakhir()
    {
        return self::latest()->first();
    }

    // Metode untuk menghitung antrian hari ini
    public static function hitungAntrianHariIni()
    {
        return self::whereDate('created_at', Carbon::today())->count();
    }
}
