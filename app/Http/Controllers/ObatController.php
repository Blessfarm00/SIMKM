<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Obat;
use Illuminate\Http\Request;


class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
            $search = $request->input('search');
            $obats = Obat::where('nama_obat', 'LIKE', "%$search%")->paginate(10);

            return view('admin.obat.index', compact('obats', 'search'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_obat' => 'required',
            //'gmbr_menu' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'jenis_obat' => 'required',
            'merek_obat' => 'required',
            'masa_berlaku' => 'required',
            'stock'=>'required',
            'harga' => 'required',
            'satuan' => 'required'
        ], [
            'nama_obat.required' => 'Nama Obat Harus Diisi',
            'jenis_obat.required' => 'Jenis Obat Harus Diisi',
            'merek_obat.required' => 'Merek Obat Harus Diisi',
            'masa_berlaku.required' => 'Tanggal Harus Diisi',
            'stock.required' => 'Stock Harus Diisi',
            'harga.required' => 'Harga Harus Diisi',
            'satuan.required' => 'Satuan Harus Diisi',
        ]);

        //$foto_file = $request->file('gmbr_menu');
        //$foto_ekstensi = $foto_file->getClientOriginalExtension();
        //$nama_foto = time() . '.' . $foto_ekstensi;
        //$foto_file->move(public_path('images'), $nama_foto);

        $data = [
            "nama_obat" => $request->get('nama_obat'),
            "jenis_obat" => $request->get('jenis_obat'),
            "merek_obat" => $request->get('merek_obat'),
            "masa_berlaku" => $request->get('masa_berlaku'),
            "stock" => $request->get('stock'),
            "harga" => $request->get('harga'),
            "satuan" => $request->get('satuan'),
        ];


        Obat::create($data);
        return redirect('/obat')->with('success', 'Data Obat Berhasil di Tambahkan');;
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
    Public function edit(Obat $obat)
    {
        return view('admin.obat.edit', [
            'obats' => $obat::find($obat->id)
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $validatedData = $request->validate([
            'nama_obat' => 'required',
            //'gmbr_menu' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'jenis_obat' => 'required',
            'merek_obat' => 'required',
            'masa_berlaku' => 'required',
            'stock' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
        ]);

        $obat->update($validatedData);

        return redirect('/obat')->with('success', 'Obat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Obat $obat)
    {
        Obat::destroy($obat->id);
       
        return redirect('/obat')->with('success', 'Data berhasil Dihapus');;
    }
}
