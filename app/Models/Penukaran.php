<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penukaran extends Model
{
    use HasFactory;

    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data\
    protected $table = "penukaran";

    //protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel penukaran
    protected $fillable = [
        'tabungan_id',
        'barang_id',
    ];

    public function barang()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh barang adalah tabel penukaran bisa di bilang relasi antara model Barang dengan model Penukaran adalah One To Many
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    // Relasi antara model Penukaran dengan model Barang (Satu penukaran memiliki satu barang)
    public function tabungan()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh tabungan adalah tabel penukaran bisa di bilang relasi antara model Tabungan dengan model Penukaran adalah One To Many
        return $this->belongsTo(Tabungan::class, 'tabungan_id');
    }
}
