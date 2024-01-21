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
        // Membuat tabel 'transaksis' untuk mencatat informasi transaksi
        Schema::create('transaksis', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom admin_id adalah foreign key yang terhubung ke tabel 'admins' dengan opsi onDelete cascade
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');

            // Kolom nasabah_id adalah foreign key yang terhubung ke tabel 'nasabahs' dengan opsi onDelete cascade
            $table->foreignId('nasabah_id')->constrained('nasabahs')->onDelete('cascade');

            // Kolom nama_nasabah akan menyimpan nama nasabah (maksimal 128 karakter)
            $table->string('nama_nasabah', 128);

            // Kolom tgl_transaksi akan menyimpan tanggal transaksi
            $table->date('tgl_transaksi');

            // Kolom jenis_sampah akan menyimpan jenis sampah (maksimal 50 karakter)
            $table->string('jenis_sampah', 50);

            // Kolom nama_sampah akan menyimpan nama sampah (maksimal 50 karakter)
            $table->string('nama_sampah', 50);

            // Kolom total_berat akan menyimpan total berat sampah dalam transaksi (maksimal 11 digit)
            $table->integer('total_berat', 11);

            // Kolom total_harga akan menyimpan total harga sampah dalam transaksi (maksimal 11 digit)
            $table->integer('total_harga', 11);

            // Kolom status akan digunakan untuk mengidentifikasi status transaksi (1: Aktif, 0: Nonaktif)
            $table->integer('status', 1);

            // Kolom 'timestamps' akan secara otomatis mencatat waktu pembuatan dan pembaruan record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
