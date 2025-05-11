<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KostFinderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // USERS
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin Satu',
                'email' => 'admin@kostfinder.com',
                'password' => Hash::make('admin123'),
                'no_phone' => '0811111111',
                'role' => 'admin',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Budi Pemilik',
                'email' => 'budi@kostfinder.com',
                'password' => Hash::make('budi123'),
                'no_phone' => '0822222222',
                'role' => 'pemilik',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Sari Pencari',
                'email' => 'sari@kostfinder.com',
                'password' => Hash::make('sari123'),
                'no_phone' => '0833333333',
                'role' => 'pencari',
                'created_at' => now(),
            ]
        ]);

        // KOSTS (tanpa main_review_id terlebih dahulu)
        DB::table('kosts')->insert([
            [
                'id' => 1,
                'owner_id' => 2,
                'name' => 'Kost Mawar',
                'alamat' => 'Jalan Andalas No. 10, Majene',
                'harga' => 750000,
                'fasilitas' => 'Wifi, Kamar Mandi Dalam, AC',
                'gender' => 'putri',
                'status' => 'aktif',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'owner_id' => 2,
                'name' => 'Kost Melati',
                'alamat' => 'Jalan H. Agus Salim No. 22, Majene',
                'harga' => 600000,
                'fasilitas' => 'Kipas Angin, Meja Belajar',
                'gender' => 'putra',
                'status' => 'aktif',
                'created_at' => now(),
            ]
        ]);

        // REVIEWS
        DB::table('reviews')->insert([
            [
                'id' => 1,
                'user_id' => 3,
                'kost_id' => 1,
                'rating' => 5,
                'comment' => 'Kostnya bersih dan pemiliknya ramah!',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'kost_id' => 2,
                'rating' => 4,
                'comment' => 'Nyaman tapi agak jauh dari kampus.',
                'created_at' => now()
            ]
        ]);

        // FAVORITES
        DB::table('favorites')->insert([
            ['user_id' => 3, 'kost_id' => 1, 'created_at' => now()],
            ['user_id' => 3, 'kost_id' => 2, 'created_at' => now()],
        ]);

        // REPORTS
        DB::table('reports')->insert([
            [
                'user_id' => 3,
                'kost_id' => 2,
                'report_text' => 'Foto kamar tidak sesuai dengan kenyataan.',
                'status' => 'pending',
                'created_at' => now()
            ]
        ]);

        // UPDATE main_review_id DI TABEL KOSTS
        DB::table('kosts')->where('id', 1)->update(['main_review_id' => 1]);
        DB::table('kosts')->where('id', 2)->update(['main_review_id' => 2]);
    }
}
