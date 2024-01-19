<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Janji;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JanjiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = Dokter::all();
        $janjis = Janji::all();

        $janjis = Janji::paginate(10);
        return view('admin.janji.index', compact('dokters', 'janjis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $dokters = Dokter::all();
        $janjis = Janji::all();
        return view('admin.janji.create', compact('dokters', 'janjis'));
        
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'dokter_id' => 'required',
            'user_id' => 'nullable',
            'tanggal' => [
                'required',
                'date',
                Rule::unique('janjis')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->input('tanggal'))
                    ->where('user_id', auth()->id());
                }),
            ],
            'jam' => 'required',
            'keterangan' => 'required',
        ], [
            'tanggal.unique' => 'Anda sudah memiliki janji pada tanggal yang sama.',
        ]);
        

        $data = [
            "nama" => $request->get('nama'),
            "alamat" => $request->get('alamat'),
            "no_hp" => $request->get('no_hp'),
            "tanggal" => $request->get('tanggal'),
            "dokter_id" => $request->get('dokter_id'),
            "jam" => $request->get('jam'),
            "keterangan" => $request->get('keterangan'),
            "user_id" =>  $request->get('user_id'),
        ];
        
        

        Janji::create($data);
        return redirect('/konfirmasis')->with('success', 'Data Anda Sudah di Record');
    }

    /**
     * Display the specified resource.
     */
    public function show(Janji $janji)
    {
        //
    }

    public function konfirmasiJanji()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Mengambil pengguna yang saat ini login
            $user_id = $user->id; // Mengambil ID pengguna yang saat ini login

            // Mengambil janji-janji yang terkait dengan pengguna yang saat ini login
            $janjis = Janji::where('user_id', $user_id)->get();

            // Kirim data pengguna dan janji-janji ke tampilan
            return view('admin.konfirmasi', compact('user', 'janjis'));
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect('/login');
        }
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Janji $janji)
    {
        return view('admin.janji.edit', [
            'janji' => $janji,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Janji $janji)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'user_id' => 'nullable',
            'tanggal' => 'required',
            'jam' => 'required',
            'alasan_penolakan' => 'required'
        ], [
            'nama.required' => 'Nama Obat Harus Diisi',
            'alamat.required' => 'Jenis Obat Harus Diisi',
            'tanggal.required' => 'Merek Obat Harus Diisi',
            'jam.required' => 'Tanggal Harus Diisi',
        ]);
        $janji->update($validatedData);

        return redirect('/janji')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Janji $janji)
    {
        Janji::destroy($janji->id);
        return redirect('/janji')->with('success', 'Data berhasil Dihapus');;
    }

    public function terimaJanji($id)
    {
        $janji = Janji::findOrFail($id);
        $janji->status = 'Diterima';
        $janji->save();

        return redirect()->back()->with('success', 'Janji berhasil ditandai sebagai Diterima.');
    }

    public function tidakTerimaJanji($id)
    {
        $janji = Janji::findOrFail($id);
        $janji->status = 'Tidak Diterima';
        $janji->save();

        return redirect()->back()->with('success', 'Janji berhasil ditandai sebagai Tidak Diterima.');
    }

}
