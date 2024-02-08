<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    //Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "transaksi";

    //protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel transaksi
    protected $fillable = [
        'admin_id',
        'nasabah_id',
        'sampah_id',
        'tgl_transaksi',
        'total_berat',
        'total_harga',
        'status',
    ];

    // Relasi antara model Transaksi dengan model Sampah (Satu transaksi memiliki banyak sampah)
    public function nasabah()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh Nasabah adalah tabel transaksi bisa di bilang relasi antara model Transaksi dengan model Nasabah adalah One To Many
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    // Relasi antara model Transaksi dengan model Admin (Satu transaksi memiliki satu admin)
    public function admin()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh Admin adalah tabel transaksi bisa di bilang relasi antara model Transaksi dengan model Admin adalah One To Many
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    // Relasi antara model Transaksi dengan model Sampah (Satu transaksi memiliki banyak sampah)
    public function sampah()
    {
        //belongsTo digunakan karena relasi antara model Transaksi dengan model Sampah adalah One To Many
        return $this->belongsTo(Sampah::class, 'sampah_id');
    }
}
