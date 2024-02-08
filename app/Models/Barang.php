<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "barang";
    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel barang
    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'stok_barang',
        'gambar_barang',
        'keterangan',
        'status',
    ];
    // Relasi antara model Barang dengan model Penukaran (Satu barang memiliki banyak penukaran)
    public function penukaran()
    {
        // HasMany digunakan karena relasi antara model Barang dengan model Penukaran adalah One To Many
        return $this->hasMany(Penukaran::class);
    }
}
