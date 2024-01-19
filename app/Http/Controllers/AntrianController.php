<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $antrians = Antrian::orderBy('created_at', 'desc')->paginate(10);
        $antrianHariIni = Antrian::hitungAntrianHariIni();

        // Memeriksa apakah pengguna sudah mengambil nomor antrian atau belum
        $penggunaSudahMengambilAntrian = FacadesSession::has('nomor_antrian'); // Ganti 'nomor_antrian' dengan key sesi yang sesuai

        return view('admin.antrian.antrian', compact('antrians', 'antrianHariIni', 'penggunaSudahMengambilAntrian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function ambilAntrian()
    {
        Antrian::ambilAntrian();

        // Menyimpan informasi bahwa pengguna telah mengambil nomor antrian ke dalam sesi
        FacadesSession::put('nomor_antrian', true);

        return redirect('/antrian')->with('message', 'Antrian diambil');
    }

    public function cetak()
    {
        $antrians = Antrian::orderBy('created_at', 'desc')->get();
        return view('admin.antrian.cetak', compact('antrians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function resetOtomatis()
    {
        Antrian::resetOtomatis();
        return redirect('/index')->with('message', 'Reset otomatis dilakukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
   
        {
            $antrians = Antrian::orderBy('created_at', 'desc')->paginate(10);;
            $antrianHariIni = Antrian::hitungAntrianHariIni();

            return view('admin.antrian.index', compact('antrians', 'antrianHariIni'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }
}
