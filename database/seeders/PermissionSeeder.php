<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Create Users',
            'Read Users',
            'Update Users',
            'Delete Users',
            'Create Roles',
            'Read Roles',
            'Update Roles',
            'Delete Roles',
            'Create Permissions',
            'Read Permissions',
            'Update Permissions',
            'Delete Permissions',
            'Create Nasabah',
            'Read Nasabah',
            'Update Nasabah',
            'Delete Nasabah',
            'Create Transaksi',
            'Read Transaksi',
            'Update Transaksi',
            'Delete Transaksi',
            'Create Barang',
            'Read Barang',
            'Update Barang',
            'Delete Barang',
            'Create Penukaran',
            'Read Penukaran',
            'Update Penukaran',
            'Delete Penukaran',
        ];

        foreach ($permissions as $permission) {
            Permissions::create([
                'name' => $permission,
            ]);
        }
    }
}
