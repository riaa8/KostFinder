<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'kost_id' => 'required|exists:kosts,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create($request->all());
        return response()->json($review, 201);
    }
}
