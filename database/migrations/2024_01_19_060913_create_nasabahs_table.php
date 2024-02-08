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
        // Membuat tabel 'nasabahs' untuk menyimpan informasi nasabah
        Schema::create('nasabah', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom user_id digunakan sebagai foreign key yang terhubung ke tabel 'users' dengan aturan onDelete cascade
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom alamat akan menyimpan alamat nasabah (maksimal 128 karakter)
            $table->string('alamat', 128);

            // Kolom no_hp akan menyimpan nomor telepon nasabah (maksimal 20 karakter)
            $table->string('no_hp', 20);

            // Kolom jenis_kelamin akan menyimpan jenis kelamin nasabah (maksimal 20 karakter)
            $table->string('jenis_kelamin', 20);

            // Kolom status akan digunakan untuk mengidentifikasi status nasabah (1: Aktif, 0: Nonaktif)
            $table->integer('status');

            // Kolom 'timestamps' akan secara otomatis mencatat waktu pembuatan dan pembaruan record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};
