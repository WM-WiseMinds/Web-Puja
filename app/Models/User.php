<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $table di gunakan untuk menyimpan nama tabel yang sesuai dalam basis data;

    //  protected $fillable di gunakan untuk menyimpan atribut yang ada pada tabel user
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    // protected $hidden di gunakan untuk menyembunyikan atribut yang ada pada tabel user
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // protected $casts di gunakan untuk mengubah tipe data dari atribut yang ada pada tabel user
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    // protected $appends di gunakan untuk menambahkan atribut yang ada pada tabel user
    protected $appends = [
        'profile_photo_url',
    ];


    // Relasi antara model User dengan model Roles (Satu role memiliki banyak user)
    public function role()
    {
        //belongsTo digunakan karena relasi yang di tuju oleh user adalah tabel Roles bisa di bilang relasi antara model Roles dengan model User adalah One To Many
        return $this->belongsTo(Roles::class, 'role_id');
    }


    // Relasi antara model User dengan model Nasabah (Satu user memiliki satu nasabah)
    public function nasabah()
    {
        //hasOne digunakan karena relasi yang di mulai oleh user yang akan dituju pada tabel Nasabah bisa di bilang relasi antara model Nasabah dengan model User adalah One To one
        return $this->hasOne(Nasabah::class);
    }
}
