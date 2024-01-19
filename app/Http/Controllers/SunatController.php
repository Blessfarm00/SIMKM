<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Sunat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SunatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dokters = Dokter::all();
        $query = Sunat::query();

        // dd($query);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_sunat', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama_pasien', 'LIKE', '%' . $search . '%');;
                // Tambahkan kolom lain yang ingin Anda tambahkan dalam pencarian di atas
            });
        }

        $sunat = $query->paginate(10);

        return view('admin.sunat.index', compact('sunat', 'dokters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());

        $sunats = Sunat::all();
        $dokters = Dokter::all();
        $q = DB::table('sunats')->select(DB::raw('MAX(RIGHT(kode_sunat,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }


        return view('admin.sunat.create', compact('sunats', 'dokters', 'kd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_sunat' => 'required',
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'dokter_id' => 'required',
            'umur' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ], [

            'kode_sunat.required' => 'Nama Obat Harus Diisi',
            'alamat.required' => 'Nama Obat Harus Diisi',
            'nama_pasien.required' => 'Nama Obat Harus Diisi',
            'dokter_id.required' => 'Nama Obat Harus Diisi',
            'umur.required' => 'Nama Obat Harus Diisi',
            'keterangan.required' => 'Nama Obat Harus Diisi',
        ]);

        //$foto_file = $request->file('gmbr_menu');
        //$foto_ekstensi = $foto_file->getClientOriginalExtension();
        //$nama_foto = time() . '.' . $foto_ekstensi;
        //$foto_file->move(public_path('images'), $nama_foto);

        $data = [
            "kode_sunat" => $request->get('kode_sunat'),
            "nama_pasien" => $request->get('nama_pasien'),
            "alamat" => $request->get('alamat'),
            "dokter_id" => $request->get('dokter_id'),
            "umur" => $request->get('umur'),
            "tanggal" => $request->get('tanggal'),
            "keterangan" => $request->get('keterangan'),
        ];


        Sunat::create($data);


        return redirect('/sunat')->with('success', 'Data Pemeriksaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sunat $sunat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $sunat = Sunat::findOrFail($id);
        $dokterList = Dokter::all();

        return view('admin.sunat.edit', compact('sunat', 'dokterList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sunat $sunat)
    {
        $validatedData = $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'dokter_id' => 'required',
            'umur' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required',
        ]);

        $sunat->update($validatedData);

        return redirect('/sunat')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sunat $sunat)
    {
        Sunat::destroy($sunat->id);
        return redirect('/sunat')->with('success', 'Data berhasil Dihapus');
    }

    public function selesai($id)
    {
        $janji = Sunat::findOrFail($id);
        $janji->pengerjaan = 'Selesai';
        $janji->save();

        return redirect()->back()->with('success', 'Berhasil ditandai sebagai Selesai.');
    }

}
