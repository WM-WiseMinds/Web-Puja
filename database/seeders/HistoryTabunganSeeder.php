<?php

namespace Database\Seeders;

use App\Models\HistoryTabungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoryTabunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryTabungan::factory()
            ->count(50)
            ->create();
    }
}
