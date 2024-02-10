<?php

namespace Database\Seeders;

use App\Models\Tabungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tabungan::factory()
            ->count(15)
            ->create();
    }
}
