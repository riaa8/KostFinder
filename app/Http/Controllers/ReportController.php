<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menyimpan laporan baru
    public function store(Request $request)
    {
        // Validasi inputan laporan
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id valid di tabel users
            'kost_id' => 'required|exists:kosts,id', // Pastikan kost_id valid di tabel kosts
            'report_text' => 'required|string', // Text laporan wajib diisi
        ]);

        // Membuat laporan baru dengan status default 'pending'
        $report = Report::create([
            'user_id' => $validated['user_id'],
            'kost_id' => $validated['kost_id'],
            'report_text' => $validated['report_text'],
            'status' => 'pending', // Status default adalah 'pending'
        ]);

        // Mengembalikan response dengan data laporan yang baru dibuat
        return response()->json($report, 201);
    }

    // Menampilkan laporan berdasarkan ID
    public function show($id)
    {
        // Mencari laporan berdasarkan ID atau memberi response error jika tidak ditemukan
        $report = Report::findOrFail($id);

        return response()->json($report, 200);
    }

    // Menampilkan semua laporan untuk kost tertentu
    public function indexByKost($kost_id)
    {
        // Mengambil semua laporan untuk kost berdasarkan ID kost
        $reports = Report::where('kost_id', $kost_id)->get();

        return response()->json($reports, 200);
    }

    // Mengupdate status laporan
    public function updateStatus(Request $request, $id)
    {
        // Validasi inputan status laporan
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai', // Status harus salah satu dari 3 pilihan
        ]);

        // Mencari laporan yang akan diupdate
        $report = Report::findOrFail($id);

        // Mengupdate status laporan
        $report->update([
            'status' => $request->status, // Status yang baru dari request
        ]);

        return response()->json($report, 200);
    }

    // Menghapus laporan berdasarkan ID
    public function destroy($id)
    {
        // Mencari laporan yang akan dihapus
        $report = Report::findOrFail($id);

        // Menghapus laporan
        $report->delete();

        return response()->json(['message' => 'Report deleted successfully'], 200);
    }
}
