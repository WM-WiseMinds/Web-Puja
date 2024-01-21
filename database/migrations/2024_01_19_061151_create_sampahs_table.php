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
        // Membuat tabel 'sampahs' untuk mencatat informasi sampah dalam sebuah transaksi
        Schema::create('sampahs', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom transaksi_id adalah foreign key yang terhubung ke tabel 'transaksis' dan akan melakukan cascade delete
            $table->foreignId('transaksi_id')->constrained('transaksis')->cascadeOnDelete();

            // Kolom jenis_sampah akan menyimpan jenis sampah (maksimal 50 karakter)
            $table->string('jenis_sampah', 50);

            // Kolom nama_sampah akan menyimpan nama sampah (maksimal 50 karakter)
            $table->string('nama_sampah', 50);

            // Kolom harga_sampah akan menyimpan harga per unit sampah (maksimal 11 digit)
            $table->integer('harga_sampah', 11);

            // Kolom jumlah_sampah akan menyimpan jumlah sampah yang terjual (maksimal 11 digit)
            $table->integer('jumlah_sampah', 11);

            // Kolom total_sampah akan menyimpan total harga sampah dalam transaksi (maksimal 11 digit)
            $table->integer('total_sampah', 11);

            // Kolom 'timestamps' akan secara otomatis mencatat waktu pembuatan dan pembaruan record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahs');
    }
};
