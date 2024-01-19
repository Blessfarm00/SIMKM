<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pemeriksaans = Pemeriksaan::all();
        $search = $request->input('search');
        
        $pasiens = Pasien::where('nama_pasien', 'LIKE', "%$search%")
        ->paginate(10);
      

        return view('admin.pasien.index', compact('pasiens', 'search','pemeriksaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nik' => 'nullable|unique:pasiens,nik|max:16',
            //'gmbr_menu' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl' => 'required',
        ], [
            'nik.required' => 'Nama Obat Harus Diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah Terdaftar',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter',
            'nama_pasien.required' => 'Nama Obat Harus Diisi',
            'alamat.required' => 'Nama Obat Harus Diisi', 
            'jenis_kelamin.required' => 'Nama Obat Harus Diisi',
            'tgl.required' => 'Tanggal Lahir Harus Diisi'
        ]);

        //$foto_file = $request->file('gmbr_menu');
        //$foto_ekstensi = $foto_file->getClientOriginalExtension();
        //$nama_foto = time() . '.' . $foto_ekstensi;
        //$foto_file->move(public_path('images'), $nama_foto);

        $data = [
            "nik" => $request->get('nik') ?: '-',
            "nama_pasien" => $request->get('nama_pasien'),
            "alamat" => $request->get('alamat'),
            "jenis_kelamin" => $request->get('jenis_kelamin'),
            "tgl" => $request->get('tgl'),
        ];

        Pasien::create($data);


        return redirect('/pasien')->with('success', 'Pasien berhasil ditambahkan');
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
    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', [
            'pasien' => $pasien,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validatedData = $request->validate([
            'nik' => 'required',
            //'gmbr_menu' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl' => 'required',
        ]);

        $pasien->update($validatedData);

        return redirect('/pasien')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Pasien $pasien)
    {
        // dd($pasien);
        Pasien::destroy($pasien->id);
        return redirect('/pasien')->with('success', 'Data berhasil Dihapus');;
    }


}
