<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create-users', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-users');
        });

        Gate::define('read-users', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-users');
        });

        Gate::define('update-users', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-users');
        });

        Gate::define('delete-users', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-users');
        });

        Gate::define('export-users', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-users');
        });

        Gate::define('create-roles', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-roles');
        });

        Gate::define('read-roles', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-roles');
        });

        Gate::define('update-roles', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-roles');
        });

        Gate::define('delete-roles', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-roles');
        });

        Gate::define('export-roles', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-roles');
        });

        Gate::define('create-permissions', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-permissions');
        });

        Gate::define('read-permissions', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-permissions');
        });

        Gate::define('update-permissions', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-permissions');
        });

        Gate::define('delete-permissions', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-permissions');
        });

        Gate::define('export-permissions', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-permissions');
        });

        Gate::define('create-nasabah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-nasabah');
        });

        Gate::define('read-nasabah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-nasabah');
        });

        Gate::define('update-nasabah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-nasabah');
        });

        Gate::define('delete-nasabah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-nasabah');
        });

        Gate::define('export-nasabah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-nasabah');
        });

        Gate::define('create-transaksi', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-transaksi');
        });

        Gate::define('read-transaksi', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-transaksi');
        });

        Gate::define('update-transaksi', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-transaksi');
        });

        Gate::define('delete-transaksi', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-transaksi');
        });

        Gate::define('export-transaksi', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-transaksi');
        });

        Gate::define('create-sampah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-sampah');
        });

        Gate::define('read-sampah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-sampah');
        });

        Gate::define('update-sampah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-sampah');
        });

        Gate::define('delete-sampah', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-sampah');
        });

        Gate::define('create-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-tabungan');
        });

        Gate::define('read-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-tabungan');
        });

        Gate::define('update-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-tabungan');
        });

        Gate::define('delete-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-tabungan');
        });

        Gate::define('withdraw-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('withdraw-tabungan');
        });

        Gate::define('export-tabungan', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-tabungan');
        });

        Gate::define('create-barang', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-barang');
        });

        Gate::define('read-barang', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-barang');
        });

        Gate::define('update-barang', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-barang');
        });

        Gate::define('delete-barang', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-barang');
        });

        Gate::define('export-barang', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-barang');
        });

        Gate::define('create-penukaran', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('create-penukaran');
        });

        Gate::define('read-penukaran', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('read-penukaran');
        });

        Gate::define('update-penukaran', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('update-penukaran');
        });

        Gate::define('delete-penukaran', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('delete-penukaran');
        });

        Gate::define('export-penukaran', function (User $user) {
            return $user->role->permissions->pluck('slug')->contains('export-penukaran');
        });
    }
}
