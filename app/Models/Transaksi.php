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
        'kode_transaksi',
        'user_id',
        'nasabah_id',
        'total_sampah',
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
    public function user()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh User adalah tabel transaksi bisa di bilang relasi antara model Transaksi dengan model User adalah One To Many
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi antara model Transaksi dengan model Sampah (Satu transaksi memiliki banyak sampah)
    public function sampah()
    {
        //hasMany digunakan karena relasi antara model Transaksi dengan model Sampah adalah One To Many
        return $this->hasMany(Sampah::class, 'transaksi_id');
    }

    public function getTotalHargaSampahAttribute()
    {
        return $this->sampah->sum(function ($sampah) {
            return $sampah->jumlah_sampah * $sampah->harga_sampah;
        });
    }

    public function getTotalJumlahSampahAttribute()
    {
        return $this->sampah->sum('jumlah_sampah');
    }
}
