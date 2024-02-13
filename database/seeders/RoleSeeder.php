<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles::factory(3)->create();
        Roles::create(['name' => 'Admin']);
        Roles::create(['name' => 'Nasabah']);
        Roles::create(['name' => 'Manager']);
    }
}
