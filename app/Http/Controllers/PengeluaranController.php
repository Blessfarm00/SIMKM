<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Pengeluaran::query();

        if ($search) {
            $query->where(function ($k) use ($search) {
                $k->where('kode_pengeluaran', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
                // Tambahkan kolom lain yang ingin Anda tambahkan dalam pencarian di atas
            });
        }

        $pengeluarans = $query->paginate(10);

        return view('admin.pengeluaran.index', compact('pengeluarans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengeluarans = Pengeluaran::all();
        $obats = Obat::all();

        $q = DB::table('pengeluarans')->select(DB::raw('MAX(RIGHT(kode_pengeluaran,4)) as kode'))->first();
        $kd = ($q ? ((int) $q->kode) + 1 : 1);
        $kd = str_pad($kd, 4, '0', STR_PAD_LEFT);

        return view('admin.pengeluaran.create', compact('pengeluarans', 'obats', 'kd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'kode_pengeluaran' => 'required',
            'obat_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',

        ], 
        [
            'kode_pengeluaran.required' => 'Kode pengeluaran Harus Diisi',
            'obat_id.required' => 'Kode Rekam Medis Harus Diisi',
            'jumlah.required' => 'Pelayanan Harus Diisi',
            'keterangan.required' => 'keterangan Harus Diisi',
        ]);

        $obat = Obat::findOrFail($validatedData['obat_id']);


        // // validasi stok produk
        // if ($obat->stock < $validatedData['obat_id']) {
        //     return redirect('/pengeluaran')->with('error', 'Stock Tidak Cukup');
        // }

        // // kurangi stok produk
        // $obat->stock -= $validatedData['jumlah'];
        // $obat->save();

        $data = [
            "kode_pengeluaran" => $request->get('kode_pengeluaran'),
            "obat_id" => $request->get('obat_id'),
            "jumlah" => $request->get('jumlah'),
            "keterangan" => $request->get('keterangan'),
        ];
        // validasi stok produk
        // if ($obat->stock < $validatedData['obat_id']) {
        //     return redirect('/pengeluaran')->with('error', 'Stock Tidak Cukup');
        // }

        // tambah stok produk
        $obat->stock += $validatedData['jumlah'];
        $obat->save();
        Pengeluaran::create($data);

        return redirect('/pengeluaran')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        $pengeluarans = Pengeluaran::all();
        $obats = Obat::all();
        

        return view('admin.pengeluaran.edit', compact('pengeluaran', 'obats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $validatedData = $request->validate([
            'obat_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        $pengeluaran->update($validatedData);

        $pengeluarans = Pengeluaran::all();
        $obats = Obat::all();

        return view('admin.pengeluaran.index', compact('pengeluarans', 'obats'));
    }


    public function destroy(Pengeluaran $pengeluaran)
    {
        Pengeluaran::destroy($pengeluaran->id);
        return redirect('/pengeluaran')->with('success', 'Data berhasil Dihapus');;
    }
}