<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Menampilkan semua pengguna
     */
    public function index()
    {
        $penggunas = Pengguna::all();
        return response()->json($penggunas);
    }

    /**
     * Menampilkan detail pengguna
     */
    public function show($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return response()->json($pengguna);
    }

    /**
     * Menambahkan pengguna baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6',
            'role' => 'required|in:admin,pemilik,pencari',
        ]);

        $pengguna = new Pengguna();
        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;
        $pengguna->kata_sandi = bcrypt($request->kata_sandi);
        $pengguna->role = $request->role;
        $pengguna->no_phone = $request->no_phone;
        $pengguna->save();

        return response()->json($pengguna, 201);
    }

    /**
     * Mengupdate data pengguna
     */
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:pengguna,email,' . $id,
            'kata_sandi' => 'nullable|string|min:6',
            'role' => 'required|in:admin,pemilik,pencari',
        ]);

        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;
        if ($request->kata_sandi) {
            $pengguna->kata_sandi = bcrypt($request->kata_sandi);
        }
        $pengguna->role = $request->role;
        $pengguna->no_phone = $request->no_phone;
        $pengguna->save();

        return response()->json($pengguna);
    }

    /**
     * Menghapus pengguna
     */
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return response()->json(null, 204);
    }
}
