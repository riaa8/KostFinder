<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Kost;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Menampilkan alamat untuk kost tertentu
     */
    public function show($kostId)
    {
        $kost = Kost::findOrFail($kostId);
        $alamat = $kost->alamat;
        
        return response()->json($alamat);
    }

    /**
     * Menambahkan alamat untuk kost tertentu
     */
    public function store(Request $request, $kostId)
    {
        $request->validate([
            'jalan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
        ]);

        $kost = Kost::findOrFail($kostId);

        $alamat = new Alamat();
        $alamat->id_kost = $kost->id;
        $alamat->jalan = $request->jalan;
        $alamat->kota = $request->kota;
        $alamat->provinsi = $request->provinsi;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->save();

        return response()->json($alamat, 201);
    }

    /**
     * Mengupdate alamat untuk kost tertentu
     */
    public function update(Request $request, $kostId)
    {
        $request->validate([
            'jalan' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'kode_pos' => 'required|string',
        ]);

        $kost = Kost::findOrFail($kostId);
        $alamat = $kost->alamat;

        $alamat->jalan = $request->jalan;
        $alamat->kota = $request->kota;
        $alamat->provinsi = $request->provinsi;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->save();

        return response()->json($alamat);
    }

    /**
     * Menghapus alamat untuk kost tertentu
     */
    public function destroy($kostId)
    {
        $kost = Kost::findOrFail($kostId);
        $alamat = $kost->alamat;
        $alamat->delete();

        return response()->json(null, 204);
    }
}
