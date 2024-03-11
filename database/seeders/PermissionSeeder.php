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
            'Export Users',
            'Create Roles',
            'Read Roles',
            'Update Roles',
            'Delete Roles',
            'Export Roles',
            'Create Permissions',
            'Read Permissions',
            'Update Permissions',
            'Delete Permissions',
            'Export Permissions',
            'Create Nasabah',
            'Read Nasabah',
            'Update Nasabah',
            'Delete Nasabah',
            'Export Nasabah',
            'Create Transaksi',
            'Read Transaksi',
            'Update Transaksi',
            'Delete Transaksi',
            'Export Transaksi',
            'Create Tabungan',
            'Read Tabungan',
            'Update Tabungan',
            'Delete Tabungan',
            'Export Tabungan',
            'Withdraw-Tabungan',
            'Create Jenis Sampah',
            'Read Jenis Sampah',
            'Update Jenis Sampah',
            'Delete Jenis Sampah',
            'Create Sampah',
            'Read Sampah',
            'Update Sampah',
            'Delete Sampah',
            'Create Barang',
            'Read Barang',
            'Update Barang',
            'Delete Barang',
            'Export Barang',
            'Create Penukaran',
            'Read Penukaran',
            'Update Penukaran',
            'Delete Penukaran',
            'Export Penukaran',
        ];

        foreach ($permissions as $permission) {
            Permissions::create([
                'name' => $permission,
            ]);
        }
    }
}
