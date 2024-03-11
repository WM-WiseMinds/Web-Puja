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

            // Kolom kode_transaksi akan digunakan untuk menyimpan kode transaksi
            $table->string('kode_transaksi', 20)->unique();

            // Kolom user_id adalah foreign key yang terhubung ke tabel 'users' dengan opsi onDelete cascade
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom nasabah_id adalah foreign key yang terhubung ke tabel 'nasabah' dengan opsi onDelete cascade
            $table->foreignId('nasabah_id')->constrained('nasabah')->onDelete('cascade');

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
