<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    // Menampilkan semua kost dengan informasi pemilik (owner)
    public function index()
    {
        // Menampilkan semua kost beserta relasi owner, favorites, dan reviews
        return response()->json(Kost::with(['owner', 'favorites', 'reviews'])->get());
    }

    // Menampilkan kost berdasarkan ID dengan relasi owner, favorites, dan reviews
    public function show($id)
    {
        // Menampilkan kost beserta relasi owner, favorites, dan reviews berdasarkan ID
        return response()->json(Kost::with(['owner', 'favorites', 'reviews'])->findOrFail($id));
    }

    // Menambahkan kost baru
    public function store(Request $request)
    {
        // Validasi inputan kost
        $request->validate([
            'owner_id' => 'required|exists:users,id', // Pastikan owner_id valid di tabel users
            'name' => 'required|string|max:255', // Nama kost wajib diisi dan maksimal 255 karakter
            'alamat' => 'required|string|max:255', // Alamat kost wajib diisi dan maksimal 255 karakter
            'harga' => 'required|integer', // Harga harus integer
            'gender' => 'required|in:putra,putri,campuran', // Gender kost harus salah satu dari pilihan
            'fasilitas' => 'nullable|string', // Fasilitas adalah string yang bisa kosong
            'status' => 'nullable|in:aktif,nonaktif,pending', // Status kost, bisa kosong dan memiliki 3 status
        ]);

        // Membuat kost baru
        $kost = Kost::create([
            'owner_id' => $request->owner_id,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
            'gender' => $request->gender,
            'fasilitas' => $request->fasilitas ?? '', // Menambahkan fasilitas (default kosong)
            'status' => $request->status ?? 'pending', // Status default adalah 'pending'
        ]);

        // Mengembalikan response dengan data kost yang baru dibuat
        return response()->json($kost, 201);
    }

    // Mengupdate kost berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi inputan kost
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|integer',
            'gender' => 'sometimes|required|in:putra,putri,campuran',
            'fasilitas' => 'nullable|string',
            'status' => 'nullable|in:aktif,nonaktif,pending',
        ]);

        // Mencari kost berdasarkan ID
        $kost = Kost::findOrFail($id);

        // Mengupdate kost dengan data baru
        $kost->update([
            'name' => $request->name ?? $kost->name,
            'alamat' => $request->alamat ?? $kost->alamat,
            'harga' => $request->harga ?? $kost->harga,
            'gender' => $request->gender ?? $kost->gender,
            'fasilitas' => $request->fasilitas ?? $kost->fasilitas,
            'status' => $request->status ?? $kost->status,
        ]);

        // Mengembalikan response dengan data kost yang sudah diupdate
        return response()->json($kost, 200);
    }

    // Menghapus kost berdasarkan ID
    public function destroy($id)
    {
        // Mencari kost berdasarkan ID
        $kost = Kost::findOrFail($id);

        // Menghapus kost
        $kost->delete();

        // Mengembalikan response sukses
        return response()->json(['message' => 'Kost deleted successfully'], 200);
    }
}
