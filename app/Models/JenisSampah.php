<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    // use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = 'jenis_sampah';

    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel jenis_sampah
    protected $fillable = [
        'jenis_sampah',
        'harga',
        'status',
    ];

    // Relasi antara model JenisSampah dengan model Sampah (Satu jenis sampah memiliki banyak sampah)
    public function sampah()
    {
        return $this->hasMany(Sampah::class);
    }
}
