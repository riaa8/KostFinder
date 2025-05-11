<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    // Menyimpan review baru
    public function store(Request $request)
    {
        // Validasi inputan review
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Menggunakan tabel 'users' untuk validasi
            'kost_id' => 'required|exists:kosts,id', // Menggunakan tabel 'kosts' untuk validasi
            'rating' => 'required|integer|min:1|max:5', // Rating antara 1 hingga 5
            'comment' => 'nullable|string', // Komentar boleh kosong atau berupa string
        ]);

        // Membuat review baru dengan data yang sudah tervalidasi
        $review = Review::create([
            'user_id' => $validated['user_id'],
            'kost_id' => $validated['kost_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null, // Menggunakan null jika komentar kosong
        ]);

        // Mengembalikan response dengan data review yang baru dibuat
        return response()->json($review, 201);
    }

    // Menampilkan review berdasarkan ID
    public function show($id)
    {
        // Mencari review berdasarkan ID atau memberi response error jika tidak ditemukan
        $review = Review::findOrFail($id);

        return response()->json($review, 200);
    }

    // Menampilkan semua review untuk kost tertentu
    public function indexByKost($kost_id)
    {
        // Mengambil semua review untuk kost berdasarkan ID kost
        $reviews = Review::where('kost_id', $kost_id)->get();

        return response()->json($reviews, 200);
    }

    // Mengupdate review berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi inputan review
        $validated = $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Mencari review yang akan diupdate
        $review = Review::findOrFail($id);

        // Update data review
        $review->update(array_filter($validated)); // `array_filter` untuk menghindari nilai null

        return response()->json($review, 200);
    }

    // Menghapus review berdasarkan ID
    public function destroy($id)
    {
        // Mencari review yang akan dihapus
        $review = Review::findOrFail($id);

        // Menghapus review
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}
