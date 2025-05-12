<?php

namespace App\Http\Controllers;

use App\Models\Kost_Fasilitas;
use App\Models\Kost;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class Kost_FasilitasController extends Controller
{
    /**
     * Menampilkan fasilitas untuk kost tertentu
     */
    public function show($kostId)
    {
        $kost = Kost::findOrFail($kostId);
        $fasilitas = $kost->fasilitas;
        
        return response()->json($fasilitas);
    }

    /**
     * Menambahkan fasilitas untuk kost tertentu
     */
    public function store(Request $request, $kostId)
    {
        $request->validate([
            'fasilitas' => 'required|array',
            'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        $kost = Kost::findOrFail($kostId);

        foreach ($request->fasilitas as $fasilitasId) {
            $kost->fasilitas()->attach($fasilitasId);
        }

        return response()->json($kost->fasilitas, 201);
    }

    /**
     * Menghapus fasilitas untuk kost tertentu
     */
    public function destroy(Request $request, $kostId)
    {
        $request->validate([
            'fasilitas' => 'required|array',
            'fasilitas.*' => 'exists:fasilitas,id',
        ]);

        $kost = Kost::findOrFail($kostId);

        foreach ($request->fasilitas as $fasilitasId) {
            $kost->fasilitas()->detach($fasilitasId);
        }

        return response()->json(null, 204);
    }
}
