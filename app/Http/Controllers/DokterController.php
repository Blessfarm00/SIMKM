<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Obat;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dokters = Dokter::where('nama_dokter', 'LIKE', "%$search%")->paginate(10);
         
        return view('admin.dokter.index', compact('dokters', 'search'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'gambar_dokter' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kelamin' => 'required|max:255', // Adjust the maximum length as needed
            'umur' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ], [
            'nama_dokter.required' => 'Nama Dokter Harus Diisi',
            'gambar_dokter.required' => 'Gambar Dokter Harus Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Diisi',
            'umur.required' => 'Umur Harus Diisi',
            'no_hp.required' => 'NO HP Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'role.required' => 'Role Harus Diisi',
        ]); 
        

        $foto_file = $request->file('gambar_dokter');
        $foto_ekstensi = $foto_file->getClientOriginalExtension();
        $nama_foto = time() . '.' . $foto_ekstensi;
        $foto_file->move(public_path('img'), $nama_foto);

        $data = [
            'nama_dokter' => $request->nama_dokter,
            'gambar_dokter' => $nama_foto,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ];

        Dokter::create($data);

        return redirect('/dokter')->with('success', 'Data dokter berhasil di Tambah');
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
    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', [
            'dokter' => $dokter,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_dokter' => 'required',
            'gambar_dokter' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'jenis_kelamin' => 'required',
            'umur' => 'required',
            'no_hp' => 'required',
            'email' => 'required',

        ]);

        if ($request->hasFile('gambar_dokter')) {
            $gambar = $request->file('gambar_dokter');
            $name = time() . '.' . $gambar->getClientOriginalExtension();
            $destinationPath = public_path('/img');
            $gambar->move($destinationPath, $name);

            $data_gambar = Dokter::findOrFail($id);
            File::delete(public_path('img/' . $data_gambar->gambar_dokter));

            $validatedData['gambar_dokter'] = $name;

            Dokter::where('id', $id)->update($validatedData);

        return redirect('/dokter')->with('success', 'Data berhasil diupdate');
    }
}

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Dokter $dokter)
    {
        Dokter::destroy($dokter->id);
        return redirect('/dokter')->with('success', 'Data berhasil Dihapus');;
    }

}
