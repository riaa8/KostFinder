<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
    {
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('password'); 
            $table->string('no_phone'); 
            $table->enum('role', ['admin', 'pemilik', 'pencari']); 
            $table->timestamps(); 
        });

        // Create reviews table (dibuat sebelum kosts karena kosts memiliki foreign key ke reviews)
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kost_id'); 
            $table->integer('rating');
            $table->text('comment')->nullable(); 
            $table->timestamps();
        });

        // Create kosts table
        Schema::create('kosts', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name'); 
            $table->string('alamat'); 
            $table->integer('harga'); 
            $table->text('fasilitas');
            $table->enum('gender', ['putra', 'putri', 'campuran']);
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('pending');
            $table->unsignedBigInteger('owner_id'); 
            $table->unsignedBigInteger('main_review_id')->nullable(); // BIGINT, Foreign Key ke reviews (one-to-one, nullable)
            $table->timestamps();
        });

        // Create favorites table
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('kost_id'); 
            $table->timestamps();
        });

        // Create reports table
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('kost_id'); 
            $table->text('report_text'); 
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();
        });

        // Add foreign key constraints after all tables are created
        Schema::table('kosts', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('main_review_id')->references('id')->on('reviews')->onDelete('set null');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kost_id')->references('id')->on('kosts')->onDelete('cascade');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kost_id')->references('id')->on('kosts')->onDelete('cascade');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kost_id')->references('id')->on('kosts')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraint issues
        Schema::dropIfExists('reports');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('kosts');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('users');
    }
};
