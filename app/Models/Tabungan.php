<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    //Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "tabungan";

    //protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel tabungan
    protected $fillable = [
        'nasabah_id',
        'tanggal',
        'debit',
        'kredit',
        'saldo',
        'keterangan',
        'status',

    ];

    // Relasi antara model Tabungan dengan model Nasabah (Satu tabungan memiliki satu nasabah)
    public function nasabah()
    {
        // belongsTo digunakan karena relasi yang di tuju oleh nasabah adalah tabel tabungan bisa di bilang relasi antara model Nasabah dengan model Tabungan adalah One To Many
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

    public function penukaran()
    {
        //hasMany digunakan karena relasi antara model Tabungan dengan model Penukaran adalah One To Many
        return $this->hasMany(Penukaran::class, 'penukaran_id');
    }
}
