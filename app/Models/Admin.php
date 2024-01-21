<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //user HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "admins";

    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel admin
    protected $fillable = [
        'nama_admin',
        'no_hp',
        'username',
        'password',
        'status',
    ];

    // Relasi antara model Admin dengan model Transaksi (Satu admin memiliki banyak transaksi)
    public function transaksi()
    {
        // HasMany digunakan karena relasi antara model Admin dengan model Transaksi adalah One To Many
        return $this->hasMany(Transaksi::class);
    }

    // Relasi antara model Admin dengan model User (Satu admin memiliki satu user)
    public function user()
    {
        //belongsTo digunakan karena relasi yang di tuju oleh user adalah tabel Admin bisa di bilang relasi antara model Admin dengan model User adalah One To One
        return $this->belongsTo(User::class);
    }
}
