<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporController extends Controller
{
    public function index($id)
    {
        return view('admin.laporan.index', [
            'pasiens' => Pasien::where('id', $id)->get(),
            'pemeriksaans' => Pemeriksaan::where('pasien_id', $id)->get(),
            'rekam_medis' => Rekam_medis::where('pasien_id', $id)->get(),
        ]);
    }



}


