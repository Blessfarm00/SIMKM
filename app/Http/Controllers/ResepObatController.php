<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Rekam_medis;
use App\Models\Resep_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{

        $grouped_resep_obats = Resep_obat::select('resep_id')   
        ->groupBy('resep_id')
        ->orderBy('resep_id')
        ->paginate(5);

        $resep_obats = Resep_obat::whereIn('resep_id', $grouped_resep_obats->pluck('resep_id'))
        ->orderBy('resep_id')
        ->get();

// Now you have grouped and paginated data in $resep_obats

    return view('admin.resep_obat.index', compact('resep_obats','grouped_resep_obats'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resep_obat=Resep_obat::all();
        $obats = Obat::all();
        $rekam_medis = Rekam_medis::all();
        
        $q = DB::table('resep_obats')->select(DB::raw('MAX(RIGHT(resep_id,4)) as kode'));
        $kd = "";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('admin.resep_obat.create', compact('obats','resep_obat', 'kd', 'rekam_medis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rekam_medis_id' => 'nullable',
            'resep_id' => 'required',
            'obat_ids' => 'required|array',
            'obat_ids.*' => 'exists:obats,id',
            'jumlah_obat' => 'required|array',
            'keterangan' => 'required|array',
            'harga' => 'required|array',
        ], [
                'obat_ids.required' => 'Pilih salah satu Obat',
                'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $rekam_medis_id = $validatedData['rekam_medis_id'];
        $resep_id = $validatedData['resep_id'];
        $totalHarga = 0; // Inisialisasi total harga

        foreach ($validatedData['obat_ids'] as $index => $obatId) {
            $hargaObat = $validatedData['harga'][$index];
            $jumlahObat = $validatedData['jumlah_obat'][$index];

            // Cek apakah stok obat mencukupi sebelum membuat resep
            $obat = Obat::find($obatId);
            if ($obat) {
                if ($obat->stock < $jumlahObat) {
                    return redirect()->back()->with('error', 'Stok obat tidak mencukupi');
                }

                $totalHargaObat = $hargaObat * $jumlahObat;
                $totalHarga += $totalHargaObat;

                $obat->stock -= $jumlahObat;
                $obat->save();

                Resep_obat::create([
                    'rekam_medis_id' => $rekam_medis_id,
                    'resep_id' => $resep_id,
                    'obat_id' => $obatId,
                    'jumlah_obat' => $jumlahObat,
                    'keterangan' => $validatedData['keterangan'][$index],
                    'harga' => $hargaObat,
                    'total_harga' => $totalHarga,
                ]);
            }
        }

        // Setelah loop, Anda bisa menyimpan total harga ke dalam database
        Resep_obat::where('rekam_medis_id', $rekam_medis_id)
            ->where('resep_id', $resep_id)
            ->update([
                'total_harga' => $totalHarga, // Simpan total harga
            ]);

        return redirect('/resep-obat')->with('success', 'Data berhasil ditambahkan');
    }




    /**
     * Display the specified resource.
     */
    public function show(Resep_obat $resep_obat)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($resep_id)
    {
        $resep_obat = Resep_obat::find($resep_id);
        $rekam_medis = Rekam_medis::all();
        $obats = Obat::all();
        $originalMedicineName = $resep_obat->obat->merek_obat; // Fetch the original medicine name

        return view('admin.resep_obat.edit', compact('obats', 'resep_obat', 'rekam_medis', 'originalMedicineName'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'rekam_medis_id' => 'nullable',
            'resep_id' => 'required',
            'obat_ids' => 'required|array',
            'obat_ids.*' => 'exists:obats,id',
            'jumlah_obat' => 'required|array',
            'keterangan' => 'required|array',
            'harga' => 'required|array',
        ], [
            'obat_ids.required' => 'Pilih salah satu Obat',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $totalHargaByResep = [];
        // Loop through the data and update each record
        foreach ($validatedData['obat_ids'] as $index => $obatId) {
            $jumlahObat = $validatedData['jumlah_obat'][$index];
            $keteranganObat = $validatedData['keterangan'][$index];
            $hargaObat = $validatedData['harga'][$index];
            $resep_id = $validatedData['resep_id'];

            // Cek apakah stok obat mencukupi sebelum melakukan perubahan
            $obat = Obat::find($obatId);
            if ($obat) {
                if ($obat->stock < $jumlahObat) {
                    return redirect()->back()->with('error', 'Stok obat tidak mencukupi');
                }

                // Kurangi stok obat yang lama
                $oldRecord = Resep_obat::find($id);
                if ($oldRecord) {
                    $obatLama = $oldRecord->obat;
                    if ($obatLama) {
                        $obatLama->stock += $oldRecord->jumlah_obat;
                        $obatLama->save();
                    }
                }

                // Kurangi stok obat yang baru
                $obat->stock -= $jumlahObat;
                $obat->save();

                $totalHargaObat = $hargaObat * $jumlahObat;

                // Menambahkan total harga obat ke resep_id yang sesuai dalam array
                if (!isset($totalHargaByResep[$resep_id])) {
                    $totalHargaByResep[$resep_id] = 0;
                }
                $totalHargaByResep[$resep_id] += $totalHargaObat;

                Resep_obat::where('id', $id)
                    ->where('resep_id', $resep_id) // Update by the record's ID
                    ->update([
                        'obat_id' => $obatId,
                        'jumlah_obat' => $jumlahObat,
                        'keterangan' => $keteranganObat,
                        'harga' => $hargaObat,
                        'total_harga' => $totalHargaObat,
                    ]);

                $id++; // Increment ID for the next record
            }
        }

        // Memperbarui catatan dengan total harga yang dihitung
        foreach ($totalHargaByResep as $resepId => $totalHarga) {
            Resep_obat::where('resep_id', $resepId)
                ->update(['total_harga' => $totalHarga]);
        }

        return redirect('/resep-obat')->with('success', 'Data berhasil diupdate');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($resep_id)
    {
        // Cari dan hapus semua data yang memiliki kode resep yang sama
        Resep_obat::where('resep_id', $resep_id)->delete();

        return redirect('/resep-obat')->with('success', 'Data berhasil dihapus');
    }
}
