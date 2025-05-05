<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('migration1', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        //Tabel users (Admin, Pemilik Kost, Pencari Kost)
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('no_phone');
            $table->enum('role', ['admin', 'pemilik', 'pencari']);
            $table->timestamps();
        });

        //Tabel Kost
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('user')->onDelete('cascade');
            $table->string('name');
            $table->string('alamat');
            $table->integer('harga');
            $table->string('fasilitas');
            $table->enum('gender', ['putra', 'putri', 'campuran']);
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->timestamps();
        });

        // Tabel Favorite
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->timestamps();
        });

        //Tabel review
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->string('comment');
            $table->timestamps();
        });

        // Tabel report
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->stirng('report_text');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration1');
        Schema::dropIfExists('user');
        Schema::dropIfExists('kosts');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('reports');

    }
};
