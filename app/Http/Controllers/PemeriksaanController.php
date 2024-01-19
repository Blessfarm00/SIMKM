<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pasiens = Pasien::all();
        $dokters = Dokter::all();

        $perPage = 10; // Jumlah data per halaman, sesuaikan sesuai kebutuhan
        $pemeriksaans = Pemeriksaan::join('pasiens', 'pemeriksaans.pasien_id', '=', 'pasiens.id')
        ->where('pasiens.nama_pasien', 'LIKE', '%' . $search . '%')
        ->select('pemeriksaans.*')
        ->paginate($perPage);


        return view('admin.pemeriksaan.index', compact('pemeriksaans', 'pasiens', 'dokters', 'search','perPage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pemeriksaans = Pemeriksaan::all();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();


        $q = DB::table('pemeriksaans')->select(DB::raw('MAX(RIGHT(kode_pemeriksaan,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
    

        return view('admin.pemeriksaan.create', compact('pemeriksaans', 'pasiens', 'dokters', 'kd'));
        return view('admin.pemeriksaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'kode_pemeriksaan' => 'required',
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'tekanan_darah' => 'nullable|max:255', // Sesuaikan panjang maksimalnya
            'suhu_badan' => 'required',
            'keluhan' => 'required|max:255',
            'tanggal' => 'required',
            // ... (field lainnya)
        ], [
            'tekanan_darah.required' => 'Tekanan Darah Harus Diisi',
            'suhu_badan.required' => 'Suhu Badan Harus Diisi',
            'keluhan.required' => 'Keluhan Harus Diisi',
            'tanggal.required' => 'Tanggal Harus Diisi'
        ]);

        $keluhan = $request->input('keluhan');
        $truncatedKeluhan = substr($keluhan,
            0,
            255
        ); 

        $tekanan_darah = substr(trim($request->input('tekanan_darah')), 0, 255);
        

        $data = [
            "kode_pemeriksaan" => $request->get('kode_pemeriksaan'),
            "pasien_id" => $request->get('pasien_id'),
            "dokter_id" => $request->get('dokter_id'),
            "tekanan_darah" => $tekanan_darah ?: '-',
            "suhu_badan" => $request->get('suhu_badan'),
            "keluhan" => $truncatedKeluhan,
            "tanggal" => $request->get('tanggal'),
        ];

        Pemeriksaan::create($data);



        return redirect('/pemeriksaan')->with('success', 'Data Pemeriksaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        
        return view('admin.pemeriksaan.edit', [
            'pemeriksaan' => $pemeriksaan,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validatedData = $request->validate([
            'kode_pemeriksaan' => 'required',
            'tekanan_darah' => 'required',
            'suhu_badan' => 'required',
            'keluhan' => 'required',
            'tanggal' => 'required',
        ]);

        $pemeriksaan->update($validatedData);

        return redirect('/pemeriksaan')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        // dd($pasien);
        Pemeriksaan::destroy($pemeriksaan->id);
        return redirect('/pemeriksaan')->with('success', 'Data berhasil Dihapus');;
    }
}
