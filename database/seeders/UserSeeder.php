<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 1,
            'status' => 'Aktif',
        ]);

        $nasabah = User::factory()->create([
            'name' => 'Nasabah',
            'email' => 'nasabah@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 2,
            'status' => 'Aktif',
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 3,
            'status' => 'Aktif',
        ]);

        User::factory(30)->create();
    }
}
