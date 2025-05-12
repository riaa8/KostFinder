<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Fasilitas;
use App\Models\Alamat;
use Illuminate\Http\Request;

class KostController extends Controller
{
    /**
     * Menampilkan semua kost
     */
    public function index()
    {
        $kosts = Kost::with(['pemilik', 'fasilitas', 'alamat', 'reviews'])->get();
        return response()->json($kosts);
    }

    /**
     * Menampilkan detail kost
     */
    public function show($id)
    {
        $kost = Kost::with(['pemilik', 'fasilitas', 'alamat', 'reviews'])->findOrFail($id);
        return response()->json($kost);
    }

    /**
     * Menambahkan kost baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'url_gambar' => 'nullable|string',
            'gender' => 'required|in:pria,wanita,umum',
            'id_pemilik' => 'required|exists:pengguna,id',
        ]);

        $kost = new Kost();
        $kost->nama = $request->nama;
        $kost->deskripsi = $request->deskripsi;
        $kost->harga_per_bulan = $request->harga_per_bulan;
        $kost->url_gambar = $request->url_gambar;
        $kost->gender = $request->gender;
        $kost->id_pemilik = $request->id_pemilik;
        $kost->save();

        // Menambahkan fasilitas jika ada
        if ($request->has('fasilitas')) {
            $kost->fasilitas()->attach($request->fasilitas);
        }

        // Menambahkan alamat
        $alamat = new Alamat();
        $alamat->id_kost = $kost->id;
        $alamat->jalan = $request->jalan;
        $alamat->kota = $request->kota;
        $alamat->provinsi = $request->provinsi;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->save();

        return response()->json($kost, 201);
    }

    /**
     * Mengupdate data kost
     */
    public function update(Request $request, $id)
    {
        $kost = Kost::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'gender' => 'required|in:pria,wanita,umum',
        ]);

        $kost->nama = $request->nama;
        $kost->deskripsi = $request->deskripsi;
        $kost->harga_per_bulan = $request->harga_per_bulan;
        $kost->gender = $request->gender;
        $kost->save();

        // Update fasilitas jika ada
        if ($request->has('fasilitas')) {
            $kost->fasilitas()->sync($request->fasilitas);
        }

        // Update alamat
        $alamat = $kost->alamat;
        $alamat->jalan = $request->jalan;
        $alamat->kota = $request->kota;
        $alamat->provinsi = $request->provinsi;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->save();

        return response()->json($kost);
    }

    /**
     * Menghapus kost
     */
    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->delete();

        return response()->json(null, 204);
    }
}
