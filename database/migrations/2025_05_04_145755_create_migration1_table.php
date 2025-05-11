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
        // Tabel users (Admin, Pemilik Kost, Pencari Kost)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_phone');
            $table->enum('role', ['admin', 'pemilik', 'pencari']);
            $table->timestamps();
        });

        // Tabel kosts 
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('alamat');
            $table->integer('harga');
            $table->string('fasilitas');
            $table->enum('gender', ['putra', 'putri', 'campuran']);
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->foreignId('main_review_id')->nullable()->unique()->constrained('reviews')->onDelete('set null');
            $table->timestamps();
        });

        // Tabel reviews 
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->string('comment');
            $table->timestamps();
        });

        

        // Tabel favorites
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel reports
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            $table->string('report_text');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('kosts');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('users');
    }
};
