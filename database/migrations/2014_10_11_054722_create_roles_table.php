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
        Schema::create('roles', function (Blueprint $table) {
            // Membuat kolom 'id' sebagai primary key
            $table->id();

            // Menambahkan kolom 'name' dengan tipe data varchar (string) dan panjang 128 karakter
            $table->string('name');

            // Menambahkan kolom timestamps untuk otomatis mengelola waktu pembuatan dan pembaruan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
