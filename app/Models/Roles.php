<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //use HasFactory untuk mengaktifkan fitur factory pada model
    use HasFactory;
    // Protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data
    protected $table = "roles";
    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel roles
    protected $fillable = [
        'name',
    ];
    // Relasi antara model Roles dengan model User (Satu role memiliki banyak user)
    public function user()
    {
        // HasMany digunakan karena relasi antara model Roles dengan model User adalah One To Many
        return $this->hasMany(User::class);
    }

    // Relasi antara model Roles dengan model Permissions (Satu role memiliki banyak permissions)
    public function permission()
    {
     // belongsToMany digunakan karena relasi antara model Roles dengan model Permissions adalah Many To Many   
     return $this->belongsToMany(Permissions::class, 'roles_permissions', 'roles_id', 'permissions_id');
    }
    
}
