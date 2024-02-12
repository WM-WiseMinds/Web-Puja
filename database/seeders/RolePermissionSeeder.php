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
        Roles::findOrFail(1)->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]);
        Roles::findOrFail(2)->permissions()->sync([2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26]);
        Roles::findOrFail(3)->permissions()->sync([5, 10, 15, 20, 25]);
    }
}
