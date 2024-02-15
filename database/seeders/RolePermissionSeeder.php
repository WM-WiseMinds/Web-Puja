<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::findOrFail(1)->permissions()->sync(range(1, 45));
        Roles::findOrFail(2)->permissions()->sync([2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26]);
        Roles::findOrFail(3)->permissions()->sync([5, 10, 15, 20, 25]);
    }
}
