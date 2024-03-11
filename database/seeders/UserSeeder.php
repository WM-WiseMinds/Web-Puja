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
        User::factory(30)->create();

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 1,
        ]);

        $nasabah = User::factory()->create([
            'name' => 'nasabah',
            'email' => 'nasabah@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 2,
        ]);

        $manager = User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('Password'),
            'role_id' => 3,
        ]);
    }
}
