<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Rekam_medis;
use App\Models\Resep_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $resep_obats = Resep_obat::all();
        $rekam_medis = Rekam_medis::all();
        $query = Pendapatan::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pelayanan', 'LIKE', '%' . $search . '%')
                    ->orWhere('kode_pendapatan', 'LIKE', '%' . $search . '%');
                // Tambahkan kolom lain yang ingin Anda tambahkan dalam pencarian di atas
            });
        }
        

        $pendapatans = $query->paginate(10);

        $totalPendapatan = $query->sum('total'); 

        return view('admin.pendapatan.index', compact('pendapatans', 'rekam_medis', 'search', 'totalPendapatan', 'resep_obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendapatans = Pendapatan::all();
        $rekam_medis = Rekam_medis::all();
        $resep_obats = Resep_obat::all();

        $q = DB::table('pendapatans')->select(DB::raw('MAX(RIGHT(kode_pendapatan,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('admin.pendapatan.create', compact('pendapatans', 'rekam_medis','kd', 'resep_obats'));
        return view('admin.pendapatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_pendapatan' => 'nullable',
            'kode_rekam_medis' => 'nullable',
            'pelayanan' => 'nullable',
            'resep_id' => 'nullable',
            'harga_obat' => 'required',
            'harga' => 'nullable',
            'tanggal' => 'required',
            'spesialisasi' => 'nullable',
            'harga_spesialisasi' => 'nullable',
        ]);

        // Menghitung total harga dari obat-obatan dalam resep
        $totalObatHarga = 0;
        if ($request->has('resep_id')) {
            $resep_id = $request->get('resep_id');
            $resep_obat = Resep_obat::where('resep_id', $resep_id)->get();
            $totalObatHarga = $resep_obat->sum('harga_obat');
        }

        $total = $request->get('harga') + $request->get('harga_obat') + $request->get('harga_spesialisasi') + $totalObatHarga; // Hitung total

        $data = [
            "kode_pendapatan" => $request->get('kode_pendapatan'),
            "kode_rekam_medis" => $request->get('kode_rekam_medis'),
            "pelayanan" => $request->get('pelayanan'),
            "harga" => $request->get('harga'),
            "harga_obat" => $request->get('harga_obat'),
            "total" => $total, // Tambahkan total ke dalam array data
            "resep_id" => $request->get('resep_id'),
            "tanggal" => $request->get('tanggal'),
            "spesialisasi" => $request->get('spesialisasi'),
            "harga_spesialisasi" => $request->get('harga_spesialisasi'),
        ];

        Pendapatan::create($data);

        return redirect('/pendapatan')->with('success', 'Data berhasil ditambahkan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendapatan $pendapatan)
    {
        return view('admin.pendapatan.edit', [
            'pendapatan' => $pendapatan,

        ]);
    }

    public function cetakPDF(Request $request)
    {
        $query = Pendapatan::query();
        $month = $request->input('month'); // Ambil bulan dari input form

        $year = date('Y', strtotime($month)); // Ambil tahun dari bulan yang dipilih
        $monthNumber = date('m', strtotime($month)); // Ambil nomor bulan dari bulan yang dipilih

        $pendapatans = Pendapatan::whereYear('tanggal', '=', $year)
            ->whereMonth('tanggal', '=', $monthNumber)
            ->get();

        $totalPendapatan = $query->sum('total'); 

        return view('admin.pendapatan.cetak', compact('pendapatans', 'month','totalPendapatan'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendapatan $pendapatan)
    {
        $validatedData = $request->validate([
            'pelayanan' => 'required',
            'harga' => 'required',
            'harga_obat' => 'required',
            'tanggal' => 'required',
            'spesialisasi' => 'required',
            'harga_spesialisasi' => 'required',
        ]);

        $pendapatan->update($validatedData);

        return redirect('/pendapatan')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendapatan $pendapatan)
    {
        Pendapatan::destroy($pendapatan->id);
        return redirect('/pendapatan')->with('success', 'Data berhasil Dihapus');;
    }
}
