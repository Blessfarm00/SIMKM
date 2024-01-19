<?php

namespace App\Http\Controllers;

use App\Models\Janji;
use Illuminate\Http\Request;

class PasienDashboardController extends Controller
{
    public function index()
    {
        $janji = Janji::all();
        return view('pasien.dashboardPas'); // Replace 'pasien.dashboard' with your actual view name
    }
}
