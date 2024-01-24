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
        Schema::create('penukarans', function (Blueprint $table) {
            // Kolom id akan digunakan sebagai primary key
            $table->id();

            // Kolom tabungan_id adalah foreign key yang terhubung ke tabel 'tabungans' dan akan melakukan cascade delete
            $table->foreignId('tabungan_id')->constrained('tabungans')->OnDelete('cascade');

            // Kolom barang_id adalah foreign key yang terhubung ke tabel 'barangs' dan akan melakukan cascade delete
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');

            // Kolom nama_barang akan menyimpan nama barang (maksimal 128 karakter)
            $table->string('nama_barang', 128);

            // Kolom jumlah_barang akan menyimpan jumlah barang yang ditukar (maksimal 11 digit)
            $table->integer('jumlah_barang');

            // Kolom keterangan akan menyimpan keterangan transaksi (maksimal 128 karakter)
            $table->string('keterangan', 128);

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
