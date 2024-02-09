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
        Schema::create('transaksi', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom user_id adalah foreign key yang terhubung ke tabel 'users' dengan opsi onDelete cascade
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom nasabah_id adalah foreign key yang terhubung ke tabel 'nasabah' dengan opsi onDelete cascade
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade');

            // Kolom tgl_transaksi akan menyimpan tanggal transaksi
            $table->date('tgl_transaksi');

            // Kolom total_berat akan menyimpan total berat sampah dalam transaksi (maksimal 11 digit)
            $table->integer('total_berat');

            // Kolom total_harga akan menyimpan total harga sampah dalam transaksi (maksimal 11 digit)
            $table->integer('total_harga');

            // Kolom status akan digunakan untuk mengidentifikasi status transaksi
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
        Schema::dropIfExists('transaksis');
    }
};
