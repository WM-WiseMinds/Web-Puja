<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;

    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "permissions";

    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel permissions
    protected $fillable = [
        'name',
    ];

    // Relasi antara model Permissions dengan model Roles (Satu permission memiliki banyak roles)
    public function roles()
    {
        // belongsToMany digunakan karena relasi antara model Permissions dengan model Roles adalah Many To Many
        return $this->belongsToMany(Roles::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
