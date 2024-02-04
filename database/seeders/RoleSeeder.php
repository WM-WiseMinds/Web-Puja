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
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'super_admin']);
        Roles::create(['name' => 'owner']);
    }
}
