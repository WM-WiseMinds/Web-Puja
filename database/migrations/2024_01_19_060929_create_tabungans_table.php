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
        // Membuat tabel 'tabungans' untuk mencatat transaksi tabungan
        Schema::create('tabungan', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom nasabah_id adalah foreign key yang terhubung ke tabel 'nasabahs' dengan opsi nullable (bisa kosong)
            $table->foreignId('nasabah_id')->constrained('nasabah')->nullable();

            // Kolom debit akan menyimpan nilai transaksi debit (maksimal 11 digit)
            $table->integer('debit');

            // Kolom kredit akan menyimpan nilai transaksi kredit (maksimal 11 digit)
            $table->integer('kredit');

            // Kolom saldo akan menyimpan saldo setelah transaksi (maksimal 11 digit)
            $table->integer('saldo');

            // Kolom keterangan akan menyimpan keterangan transaksi (maksimal 128 karakter)
            $table->string('keterangan', 128);

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
        Schema::dropIfExists('tabungans');
    }
};
