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
        Roles::findOrFail(1)->permissions()->sync(range(1, 50));
        Roles::findOrFail(2)->permissions()->sync([22, 27, 33, 38, 42, 47]);
        Roles::findOrFail(3)->permissions()->sync([5, 10, 15, 20, 25, 30, 36, 45, 50]);
    }
}
