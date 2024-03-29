<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;
    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "sampah";
    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel sampah
    protected $fillable = [
        'transaksi_id',
        'jenis_sampah_id',
        'nama_sampah',
        'harga_sampah',
        'jumlah_sampah',
    ];
    // Relasi antara model Sampah dengan model Transaksi (Satu sampah memiliki banyak transaksi)
    public function transaksi()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh transaksi adalah tabel Sampah bisa di bilang relasi antara model Sampah dengan model Transaksi adalah One To Many
        return $this->belongsTo(Transaksi::class);
    }

    // Relasi antara model Sampah dengan model JenisSampah (Satu sampah memiliki satu jenis sampah)
    public function jenisSampah()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh jenisSampah adalah tabel Sampah bisa di bilang relasi antara model Sampah dengan model JenisSampah adalah One To Many
        return $this->belongsTo(JenisSampah::class);
    }
}
