<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Rekam_medis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $rekam_medis = Rekam_medis::join('pasiens', 'rekam_medis.pasien_id', '=', 'pasiens.id')
        ->where(function ($query) use ($search) {
            $query->where('rekam_medis.kode_rekam_medis', 'LIKE', "%$search%")
            ->orWhere('rekam_medis.diagnosa', 'LIKE', "%$search%")
            ->orWhere('pasiens.nama_pasien', 'LIKE', "%$search%");
        })
        ->select('rekam_medis.*')
        ->paginate(10);

        return view('admin.rekam_medis.index', compact('rekam_medis', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rekam_medis = Rekam_medis::all();
        $pemeriksaans = Pemeriksaan::all();
        $pasiens = Pasien::all();
        $q = DB::table('rekam_medis')->select(DB::raw('MAX(RIGHT(kode_rekam_medis,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }


        return view('admin.rekam_medis.create', compact('rekam_medis', 'pemeriksaans','kd','pasiens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validationData = $request->validate([
            'kode_rekam_medis' => 'required',
            'pemeriksaan_id' => 'required',
            'pasien_id' => 'required',
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'rujukan' => 'required',
        ]);

        Rekam_medis::create($validationData);
        return redirect('/rekam-medis')->with('success', 'Data Rekam Medis berhasil ditambahkan');

    }

    public function cetak()
    {

        $rekam_medis = Rekam_medis::all();

        return view('admin.rekam_medis.cetak', compact('rekam_medis'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Rekam_medis $rekam_medis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekam_medis $rekam_medis)
    {
        return view('admin.rekam_medis.edit', [
            'rekam_medis' => $rekam_medis,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekam_medis $rekam_medis)
    {


        $validatedData = $request->validate([
            'diagnosa' => 'required',
            'tindakan' => 'required',
            'rujukan' => 'required',

        ]);

        $rekam_medis->update($validatedData);

        return redirect('/rekam-medis')->with('success', 'Data berhasil diupdate');
    }

    public function cetakById($id)
    {
        try {
            $rekam_medis = Rekam_medis::find($id);

            if (!$rekam_medis) {
                return redirect()->route('home')->with('error', 'Rekam medis tidak ditemukan');
            }

            return view('admin.rekam_medis.cetak', compact('rekam_medis'));
        } catch (\Exception $exception) {
            return redirect()->route('home')->with('error', 'Terjadi kesalahan: ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekam_medis $rekam_medis)
    {
        Rekam_medis::destroy($rekam_medis->id);
        return redirect('/rekam-medis')->with('success', 'Data berhasil Dihapus');;
    }
}
