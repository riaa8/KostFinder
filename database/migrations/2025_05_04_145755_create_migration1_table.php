<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Pengguna
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->enum('role', ['admin', 'pemilik', 'pencari']);
            $table->string('no_phone')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabel Kosts
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->decimal('harga_per_bulan', 10, 2);
            $table->string('url_gambar')->nullable();
            $table->enum('gender', ['putra', 'putri', 'campur']);
            $table->unsignedBigInteger('id_pemilik');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_pemilik')->references('id')->on('pengguna')->onDelete('cascade');
        });

        // Tabel Fasilitas
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->timestamp('created_at')->useCurrent();
        });

        // Tabel Pivot Kost-Fasilitas
        Schema::create('kost_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kost');
            $table->unsignedBigInteger('id_fasilitas');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_kost')->references('id')->on('kosts')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
        });

        // Tabel Alamat
        Schema::create('alamat', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kost')->primary();
            $table->string('jalan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_kost')->references('id')->on('kosts')->onDelete('cascade');
        });

        // Tabel Review
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kost');
            $table->unsignedBigInteger('id_pengguna');
            $table->tinyInteger('rating');
            $table->text('komentar')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_kost')->references('id')->on('kosts')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
        Schema::dropIfExists('alamat');
        Schema::dropIfExists('kost_fasilitas');
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('kosts');
        Schema::dropIfExists('pengguna');
    }
};
