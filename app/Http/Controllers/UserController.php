<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required',
            'role' => 'required|in:admin,pemilik,pencari'
        ]);

        $user = User::create([
            ...$request->only(['name', 'email', 'no_phone', 'role']),
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }
}
