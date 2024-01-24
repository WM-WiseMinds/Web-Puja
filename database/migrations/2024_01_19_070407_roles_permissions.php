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
        Schema::create('roles_permissions', function (Blueprint $table) {
            // Menghubungkan kolom role_id dengan tabel 'role' 
            $table->foreignId('role_id')->constrained('roles');
            
            // Menghubungkan kolom permission_id dengan tabel 'permission'
            $table->foreignId('permissions_id')->constrained('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
