<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KostFinderSeeder extends Seeder
{
    public function run(): void
    {
        // Pengguna
        DB::table('pengguna')->insert([
            [
                'nama' => 'Admin Satu',
                'email' => 'admin@kostfinder.com',
                'kata_sandi' => Hash::make('admin123'),
                'role' => 'admin',
                'no_phone' => null,
                'created_at' => now()
            ],
            [
                'nama' => 'Pemilik Kost',
                'email' => 'pemilik@kostfinder.com',
                'kata_sandi' => Hash::make('pemilik123'),
                'role' => 'pemilik',
                'no_phone' => '081234567890',
                'created_at' => now()
            ],
            [
                'nama' => 'Pencari Kost',
                'email' => 'pencari@kostfinder.com',
                'kata_sandi' => Hash::make('pencari123'),
                'role' => 'pencari',
                'no_phone' => '082233445566',
                'created_at' => now()
            ]
        ]);

        // Ambil ID pengguna
        $pemilikId = DB::table('pengguna')->where('email', 'pemilik@kostfinder.com')->value('id');
        $pencariId = DB::table('pengguna')->where('email', 'pencari@kostfinder.com')->value('id');

        // Kosts
        DB::table('kosts')->insert([
            [
                'nama' => 'Kost Putri Mawar',
                'deskripsi' => 'Kost nyaman dan bersih khusus putri',
                'harga_per_bulan' => 800000,
                'url_gambar' => 'mawar.jpg',
                'gender' => 'putri',
                'id_pemilik' => $pemilikId,
                'created_at' => now()
            ],
            [
                'nama' => 'Kost Putra Melati',
                'deskripsi' => 'Kost strategis dekat kampus',
                'harga_per_bulan' => 750000,
                'url_gambar' => 'melati.jpg',
                'gender' => 'putra',
                'id_pemilik' => $pemilikId,
                'created_at' => now()
            ]
        ]);

        $kost1 = DB::table('kosts')->where('nama', 'Kost Putri Mawar')->value('id');
        $kost2 = DB::table('kosts')->where('nama', 'Kost Putra Melati')->value('id');

        // Fasilitas
        DB::table('fasilitas')->insert([
            ['nama_fasilitas' => 'WiFi', 'created_at' => now()],
            ['nama_fasilitas' => 'AC', 'created_at' => now()],
            ['nama_fasilitas' => 'Kamar Mandi Dalam', 'created_at' => now()],
        ]);

        $wifi = DB::table('fasilitas')->where('nama_fasilitas', 'WiFi')->value('id');
        $ac = DB::table('fasilitas')->where('nama_fasilitas', 'AC')->value('id');
        $km = DB::table('fasilitas')->where('nama_fasilitas', 'Kamar Mandi Dalam')->value('id');

        // Kost-Fasilitas
        DB::table('kost_fasilitas')->insert([
            ['id_kost' => $kost1, 'id_fasilitas' => $wifi, 'created_at' => now()],
            ['id_kost' => $kost1, 'id_fasilitas' => $ac, 'created_at' => now()],
            ['id_kost' => $kost2, 'id_fasilitas' => $wifi, 'created_at' => now()],
            ['id_kost' => $kost2, 'id_fasilitas' => $km, 'created_at' => now()],
        ]);

        // Alamat
        DB::table('alamat')->insert([
            [
                'id_kost' => $kost1,
                'jalan' => 'Jl. Mawar No.12',
                'kota' => 'Majene',
                'provinsi' => 'Sulawesi Barat',
                'kode_pos' => '91412',
                'created_at' => now()
            ],
            [
                'id_kost' => $kost2,
                'jalan' => 'Jl. Melati No.5',
                'kota' => 'Majene',
                'provinsi' => 'Sulawesi Barat',
                'kode_pos' => '91412',
                'created_at' => now()
            ]
        ]);

        // Review
        DB::table('review')->insert([
            [
                'id_kost' => $kost1,
                'id_pengguna' => $pencariId,
                'rating' => 5,
                'komentar' => 'Kost sangat bersih dan nyaman!',
                'created_at' => now()
            ],
            [
                'id_kost' => $kost2,
                'id_pengguna' => $pencariId,
                'rating' => 4,
                'komentar' => 'Dekat kampus dan ada WiFi!',
                'created_at' => now()
            ]
        ]);
    }
}
