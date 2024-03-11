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
        Schema::create('sampah', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom transaksi_id akan digunakan sebagai foreign key untuk menghubung tabel sampah dengan tabel transaksi
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');

            // Kolom jenis_sampah_id akan digunakan sebagai foreign key untuk menghubung tabel sampah dengan tabel jenis_sampah
            $table->foreignId('jenis_sampah_id')->constrained('jenis_sampah')->onDelete('cascade');

            // Kolom nama_sampah akan menyimpan nama sampah (maksimal 50 karakter)
            $table->string('nama_sampah', 50);

            // Kolom harga_sampah akan menyimpan harga per unit sampah (maksimal 11 digit)
            $table->integer('harga_sampah');

            // Kolom jumlah_sampah akan menyimpan jumlah sampah yang terjual (maksimal 11 digit)
            $table->integer('jumlah_sampah');

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
