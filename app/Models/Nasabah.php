<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;
    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "nasabah";
    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel nasabah
    protected $fillable = [
        'user_id',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'status',
    ];
    // Relasi antara model Nasabah dengan model Transaksi (Satu nasabah memiliki banyak transaksi)
    public function transaksi()
    {
        // HasMany digunakan karena relasi antara model Nasabah dengan model Transaksi adalah One To Many
        return $this->hasMany(Transaksi::class);
    }
    // Relasi antara model Nasabah dengan model Tabungan (Satu nasabah memiliki banyak tabungan)
    public function tabungan()
    {
        // HasMany digunakan karena relasi antara model Nasabah dengan model Tabungan adalah One To Many
        return $this->hasMany(Tabungan::class);
    }

    // Relasi antara model Nasabah dengan model User (Satu nasabah memiliki satu user)
    public function user()
    {
        //belongsTo digunakan karena relasi yang di tuju oleh user adalah tabel nasabah bisa di bilang relasi antara model Nasabah dengan model User adalah One To One
        return $this->belongsTo(User::class);
    }
}
