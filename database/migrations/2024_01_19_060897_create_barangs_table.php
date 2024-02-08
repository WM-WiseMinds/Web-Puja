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
        // Membuat tabel 'barangs' untuk menyimpan informasi tentang barang-barang
        Schema::create('barang', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom nama_barang akan menyimpan nama barang (maksimal 128 karakter)
            $table->string('nama_barang', 128);

            // Kolom harga_barang akan menyimpan harga barang (maksimal 11 digit)
            $table->integer('harga_barang');

            // Kolom stok_barang akan menyimpan jumlah barang yang tersedia (maksimal 11 digit)
            $table->integer('stok_barang');

            // Kolom gambar_barang akan menyimpan nama file gambar barang (maksimal 128 karakter)
            $table->string('gambar_barang', 128);

            // Kolom keterangan akan menyimpan deskripsi atau keterangan barang (maksimal 225 karakter)
            $table->string('keterangan', 225);

            // Kolom status akan digunakan untuk mengidentifikasi status barang
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');

            // Kolom 'timestamps' akan secara otomatis mencatat waktu pembuatan dan pembaruan record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
