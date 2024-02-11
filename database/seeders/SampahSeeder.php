<?php

namespace Database\Seeders;

use App\Models\Sampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sampah::factory()->count(50)->create();
    }
}
