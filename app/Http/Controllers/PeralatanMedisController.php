<?php

namespace App\Http\Controllers;

use App\Models\Peralatan_medis;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PeralatanMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Peralatan_medis::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'LIKE', '%' . $search . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $search . '%');
                // Tambahkan kolom lain yang ingin Anda tambahkan dalam pencarian di atas
            });
        }

        $peralatan_medis = $query->paginate(10);

        return view('admin.peralatan_medis.index', compact('peralatan_medis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.peralatan_medis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'kode_alat' => 'required',
            'nama_alat' => 'required',
            'gambar_alat' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jumlah_alat' => 'required',
            'keterangan' => 'required',
        ], [
            'nama_alat.required' => 'Nama peralatan_medis harus diisi.',
            'gambar_alat.required' => 'Gambar alat harus diisi.',
            'gambar_alat.image' => 'File yang diupload harus berupa gambar.',
            'gambar_alat.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, atau svg.',
            'gambar_alat.max' => 'Ukuran gambar tidak boleh melebihi 2048 KB.',
            'jumlah_alat.required' => 'Jumlah Alat harus diisi.',
            'keterangan.required' => 'keterangan harus diisi.',
        ]);

        $foto_file = $request->file('gambar_alat');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('img'), $nama_foto);

        $data = [
            'kode_alat' => $request->kode_alat,
            'nama_alat' => $request->nama_alat,
            'gambar_alat' => $nama_foto,
            'jumlah_alat' => $request->jumlah_alat,
            'keterangan' => $request->keterangan,
        ];

        peralatan_medis::create($data);
        return redirect('/peralatan_medis')->with('success', 'Data Alat Medis berhasil ditambahkan');
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
    public function edit(peralatan_medis $peralatan_medis)
    {
        return view('admin.peralatan_medis.edit', [
            'peralatan_medis' => $peralatan_medis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'nama_alat' => 'required',
            'gambar_alat' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'jumlah_alat' => 'required',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('gambar_alat')) {
            $gambar = $request->file('gambar_alat');
            $name = time() . '.' . $gambar->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $gambar->move($destinationPath, $name);

            $data_gambar = Peralatan_medis::findOrFail($id);
            File::delete(public_path('img/' . $data_gambar->gambar_alat));

            $validatedData['gambar_alat'] = $name;

            Peralatan_medis::where('id', $id)->update($validatedData);

            return redirect('/peralatan_medis')->with('success', 'Data berhasil diupdate');
        }
  
       
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(peralatan_medis $peralatan_medis)
    {
        peralatan_medis::destroy($peralatan_medis->id);
        return redirect('/peralatan_medis')->with('success', 'Data berhasil Dihapus');;
    }
}
