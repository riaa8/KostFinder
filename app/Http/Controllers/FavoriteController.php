<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Menampilkan semua favorit dengan informasi pengguna (user) dan kost
    public function index()
    {
        // Mengambil data favorite beserta relasi user dan kost
        return response()->json(Favorite::with(['user', 'kost'])->get());
    }

    // Menambahkan favorit baru
    public function store(Request $request)
    {
        // Validasi inputan favorit
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validasi user_id agar sesuai dengan id di tabel users
            'kost_id' => 'required|exists:kosts,id', // Validasi kost_id agar sesuai dengan id di tabel kosts
        ]);

        // Mengecek jika user sudah menyukai kost tersebut
        $existingFavorite = Favorite::where('user_id', $request->user_id)
                                     ->where('kost_id', $request->kost_id)
                                     ->first();
        
        // Jika sudah ada, tidak perlu menambah favorit lagi
        if ($existingFavorite) {
            return response()->json(['message' => 'Kost ini sudah ada di favorit Anda'], 400);
        }

        // Menambahkan favorit baru
        $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'kost_id' => $request->kost_id,
        ]);

        // Mengembalikan response dengan data favorit yang baru dibuat
        return response()->json($favorite, 201);
    }

    // Menghapus favorit berdasarkan user_id dan kost_id
    public function destroy($user_id, $kost_id)
    {
        // Mencari favorit berdasarkan user_id dan kost_id
        $favorite = Favorite::where('user_id', $user_id)
                            ->where('kost_id', $kost_id)
                            ->first();

        // Jika favorit tidak ditemukan, kembalikan response error
        if (!$favorite) {
            return response()->json(['message' => 'Favorit tidak ditemukan'], 404);
        }

        // Menghapus favorit
        $favorite->delete();

        // Mengembalikan response sukses
        return response()->json(['message' => 'Favorit berhasil dihapus'], 200);
    }
}
