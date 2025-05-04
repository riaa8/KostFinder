<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // users
        DB::table('user')->insert([
            [
                'name' => 'Admin Satu',
                'email' => 'admin@kostfinder.com',
                'password' => Hash::make('admin123'),
                'no_phone' => '0811111111',
                'role' => 'admin',
                'created_at' => now(),
            ],
            [
                'name' => 'Budi Pemilik',
                'email' => 'budi@kostfinder.com',
                'password' => Hash::make('budi123'),
                'no_phone' => '0822222222',
                'role' => 'pemilik',
                'created_at' => now(),
            ],
            [
                'name' => 'Sari Pencari',
                'email' => 'sari@kostfinder.com',
                'password' => Hash::make('sari123'),
                'no_phone' => '0833333333',
                'role' => 'pencari',
                'created_at' => now(),
            ]
        ]);

        //kost
        DB::table('kosts')->insert([
            [
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

        // favorite
        DB::table('favorites')->insert([
            ['user_id' => 3, 'kost_id' => 1, 'created_at' => now()],
            ['user_id' => 3, 'kost_id' => 2, 'created_at' => now()],
        ]);

        // reviews
        DB::table('reviews')->insert([
            [
                'user_id' => 3,
                'kost_id' => 1,
                'rating' => 5,
                'comment' => 'Kostnya bersih dan pemiliknya ramah!',
                'created_at' => now()
            ],
            [
                'user_id' => 3,
                'kost_id' => 2,
                'rating' => 4,
                'comment' => 'Nyaman tapi agak jauh dari kampus.',
                'created_at' => now()
            ]
        ]);

        //report 
        DB::table('reports')->insert([
            [
                'user_id' => 3,
                'kost_id' => 2,
                'report_text' => 'Foto kamar tidak sesuai dengan kenyataan.',
                'status' => 'pending',
                'created_at' => now()
            ]
        ]);
    }
}
