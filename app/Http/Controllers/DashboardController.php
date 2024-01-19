<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Janji;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\Pendapatan; // Ganti dengan model yang sesuai
use App\Models\Rekam_medis;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total pendapatan dari data di database
        $totalPendapatan = Pendapatan::whereMonth('created_at', now()->month)->sum('total');

        $totalJanji = Janji::whereMonth('created_at', now()->month)->count(); // Menghitung jumlah entri dalam bulan ini

        $jumlahObats = Obat::count();

        return view('admin.dashboard', compact('jumlahObats', 'totalPendapatan','totalJanji'));
        
    }
}
