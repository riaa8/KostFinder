<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // Menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        // Mencari user atau memberi response error jika tidak ditemukan
        $user = User::findOrFail($id);

        return response()->json($user, 200);
    }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi inputan dari pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pemilik,pencari',
            'no_phone' => 'required|string|max:15', // Menambahkan validasi untuk nomor telepon
        ]);

        // Menyimpan pengguna baru dengan mengenkripsi password
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_phone' => $validated['no_phone'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        // Mengembalikan response dengan data pengguna yang baru disimpan
        return response()->json($user, 201);
    }

    // Update data pengguna (opsional)
    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,pemilik,pencari',
            'no_phone' => 'nullable|string|max:15',
        ]);

        // Mencari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->update(array_filter($validated)); // `array_filter` untuk menghindari nilai null

        // Jika password baru ada, maka kita update password yang terenkripsi
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
            $user->save();
        }

        // Mengembalikan response data pengguna yang sudah diupdate
        return response()->json($user, 200);
    }

    // Menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
