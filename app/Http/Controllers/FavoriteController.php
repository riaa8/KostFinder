<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function index()
    {
        return response()->json(Favorite::with(['user', 'kost'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'kost_id' => 'required|exists:kosts,id'
        ]);

        $favorite = Favorite::create($request->all());
        return response()->json($favorite, 201);
    }
}
