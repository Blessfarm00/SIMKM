<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pengambilan;
use Illuminate\Http\Request;

class PengambilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $obats = Obat::all();
        $pengambilans = Pengambilan::all();

        $pengambilans = Pengambilan::paginate(10);
        return view('admin.pengambilan.index', compact('pengambilans', 'obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $obats=Obat::all();

        return view('admin.pengambilan.create', compact('obats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    // dd($request->all());
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'obat_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ], [
            'obat_id.required' => 'Kode Rekam Medis Harus Diisi',
            'jumlah.required' => 'Pelayanan Harus Diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah harus lebih dari 0',
        ]);

        $obat = Obat::findOrFail($validatedData['obat_id']);

        // validasi stok produk
        if ($obat->stock < $validatedData['jumlah']) {
            return redirect('/pengambilan')->with('error', 'Stock Tidak Cukup');
        }

        // kurangi stok produk
        $obat->stock -= $validatedData['jumlah'];
        $obat->save();

        Pengambilan::create([
            "obat_id" => $obat->id,
            "jumlah" => $validatedData['jumlah'],
        ]);

        return redirect('/pengambilan')->with('success', 'Data berhasil ditambahkan');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Pengambilan $pengambilan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengambilan $pengambilan)
    {
        
        $pengambilans = Pengambilan::all();
        $obats = Obat::all();


        return view('admin.pengambilan.edit', compact('pengambilan', 'obats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengambilan $pengambilan)
    {
        $validatedData = $request->validate([
            'obat_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ], [
            'obat_id.required' => 'Kode Rekam Medis Harus Diisi',
            'jumlah.required' => 'Pelayanan Harus Diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah harus lebih dari 0',
        ]);

        $obat = Obat::findOrFail($validatedData['obat_id']);

        // Mengembalikan stok yang lama karena data akan diubah
        $obat->stock += $pengambilan->jumlah;

        // validasi stok produk
        if ($obat->stock < $validatedData['jumlah']) {
            return redirect('/pengambilan')->with('error', 'Stock Tidak Cukup');
        }

        // Mengurangi stok sesuai perubahan
        $obat->stock -= $validatedData['jumlah'];
        $obat->save();

        $pengambilan->update([
            "obat_id" => $obat->id,
            "jumlah" => $validatedData['jumlah'],
        ]);

        return redirect('/pengambilan')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengambilan $pengambilan)
    {
        Pengambilan::destroy($pengambilan->id);
        return redirect('/pengambilan')->with('success', 'Data berhasil Dihapus');;
    }
}
