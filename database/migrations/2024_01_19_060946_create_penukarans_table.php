<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Livewire\on;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel 'penukarans' untuk mencatat transaksi penukaran barang
        Schema::create('penukaran', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom tabungan_id adalah foreign key yang terhubung ke tabel 'tabungan' dan akan melakukan cascade delete
            $table->foreignId('tabungan_id')->constrained('tabungan')->OnDelete('cascade');

            // Kolom barang_id adalah foreign key yang terhubung ke tabel 'barang' dan akan melakukan cascade delete
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');

            // Kolom harga_barang adalah data yang akan menyimpan harga barang saat terjadinya penukaran
            $table->integer('harga_barang_saat_tukar');

            // Kolom 'timestamps' akan secara otomatis mencatat waktu pembuatan dan pembaruan record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penukarans');
    }
};
