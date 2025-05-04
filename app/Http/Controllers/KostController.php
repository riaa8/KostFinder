<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    //
    public function index()
    {
        return response()->json(Kost::with('owner')->get());
    }

    public function show($id)
    {
        return response()->json(Kost::with(['owner', 'favorites', 'reviews'])->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:user,id',
            'name' => 'required',
            'alamat' => 'required',
            'harga' => 'required|integer',
            'gender' => 'required|in:putra,putri,campuran',
        ]);

        $kost = Kost::create($request->all());
        return response()->json($kost, 201);
    }
}
