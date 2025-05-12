<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Kost;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan semua review untuk kost tertentu
     */
    public function index($kostId)
    {
        $kost = Kost::findOrFail($kostId);
        $reviews = $kost->reviews;
        return response()->json($reviews);
    }

    /**
     * Menambahkan review baru untuk kost
     */
    public function store(Request $request, $kostId)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:pengguna,id',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string',
        ]);

        $review = new Review();
        $review->id_kost = $kostId;
        $review->id_pengguna = $request->id_pengguna;
        $review->rating = $request->rating;
        $review->komentar = $request->komentar;
        $review->save();

        return response()->json($review, 201);
    }

    /**
     * Mengupdate review
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string',
        ]);

        $review->rating = $request->rating;
        $review->komentar = $request->komentar;
        $review->save();

        return response()->json($review);
    }

    /**
     * Menghapus review
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(null, 204);
    }
}
