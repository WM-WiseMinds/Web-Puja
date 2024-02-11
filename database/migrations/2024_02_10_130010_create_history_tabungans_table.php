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
        // Membuat tabel baru dengan nama 'history_tabungan'
        Schema::create('history_tabungan', function (Blueprint $table) {
            // Menambahkan kolom 'id' sebagai primary key
            $table->id();

            // Menambahkan kolom 'tabungan_id' sebagai foreign key yang merujuk ke tabel 'tabungan'
            // Jika data di tabel 'tabungan' dihapus, maka data yang berhubungan di tabel ini juga akan dihapus (cascade)
            $table->foreignId('tabungan_id')->constrained('tabungan')->onDelete('cascade');

            // Menambahkan kolom 'debit' dengan tipe data integer
            $table->integer('debit');

            // Menambahkan kolom 'kredit' dengan tipe data integer
            $table->integer('kredit');

            // Menambahkan kolom 'keterangan' dengan tipe data string dan panjang maksimum 128 karakter
            $table->string('keterangan', 128);

            // Menambahkan kolom 'created_at' dan 'updated_at' untuk mencatat waktu pembuatan dan perubahan data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_tabungans');
    }
};
