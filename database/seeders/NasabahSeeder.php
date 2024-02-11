<?php

namespace Database\Seeders;

use App\Models\Nasabah;
use App\Models\Tabungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nasabah::factory()->count(20)->create();
    }
}
