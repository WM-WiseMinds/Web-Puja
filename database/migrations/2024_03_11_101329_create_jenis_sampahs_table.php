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
        Schema::create('jenis_sampah', function (Blueprint $table) {
            // Menambahkan kolom 'id' sebagai primary key
            $table->id();
            // Menambahkan kolom 'jenis_sample' dengan tipe data string dan panjang maksimum 128 karakter
            $table->string('jenis_sampah', 128);
            // Menambahkan kolom 'harga' dengan tipe data integer
            $table->integer('harga');
            // Menambahkan kolom 'timestamp' untuk mencatat waktu pembuatan dan perubahan data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_sampah');
    }
};
