<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\PerawatanLuka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatanLukaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dokters = Dokter::all();
        $query = PerawatanLuka::query();

        // dd($query);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_perawatan', 'LIKE', '%' . $search . '%')
                    ->orWhere('nama_pasien', 'LIKE', '%' . $search . '%');;
                // Tambahkan kolom lain yang ingin Anda tambahkan dalam pencarian di atas
            });
        }

        $perawatanLuka = $query->paginate(10);

        return view('admin.perawatan.index', compact('perawatanLuka', 'dokters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
 

        $perawatans = PerawatanLuka::all();
        $dokters = Dokter::all();
        $q = DB::table('perawatan_lukas')->select(DB::raw('MAX(RIGHT(kode_perawatan,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }


        return view('admin.perawatan.create', compact('perawatans', 'dokters', 'kd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_perawatan' => 'required',
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'dokter_id' => 'required',
            'jenis_luka' => 'required',
            'status' => 'required',
        ], [
            // ... Validation messages ...
        ]);

        $data = [
            "kode_perawatan" => $request->get('kode_perawatan'),
            "nama_pasien" => $request->get('nama_pasien'),
            "alamat" => $request->get('alamat'),
            "dokter_id" => $request->get('dokter_id'),
            "jenis_luka" => $request->get('jenis_luka'),
            "status" => $request->get('status'),
        ];

        $status = $validatedData['status'];

        // Convert "100%" to "Selesai"
        if ($status === '100%') {
            $pengerjaan = 'Selesai';
        }

        $data['status'] = $status; // Update the status in the data array

        PerawatanLuka::create($data);

        return redirect('/perawatan')->with('success', 'Data Pemeriksaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PerawatanLuka $perawatanLuka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit(PerawatanLuka  $perawatan)
    {
        return view('admin.perawatan.edit', [
            'perawatans' => $perawatan::find($perawatan->id)
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $perawatanLuka = PerawatanLuka::findOrFail($id); // Find the specific instance using the ID

        $validatedData = $request->validate([
            'nama_pasien' => 'required',
            'alamat' => 'required',
            'jenis_luka' => 'required',
            'status' => 'required',
        ]);

        $perawatanLuka = PerawatanLuka::findOrFail($id);
        $perawatanLuka->update($validatedData);

        // Cek apakah status baru adalah "100%", dan ubah pengerjaan jika perlu
        if ($request->input('status') === '100%') {
            $perawatanLuka->pengerjaan = 'Selesai';
            $perawatanLuka->save();
        }

        

        return redirect('/perawatan')->with('success', 'Data Pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $perawatanLuka = PerawatanLuka::findOrFail($id);
    $perawatanLuka->delete();

    return redirect('/perawatan')->with('success', 'Data Pemeriksaan berhasil dihapus');
}

   

}
