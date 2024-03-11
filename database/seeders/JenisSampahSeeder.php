<?php

namespace Database\Seeders;

use App\Models\JenisSampah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSampah = [
            'Organik',
            'Anorganik',
            'B3',
            'Non B3',
            'Lainnya',
        ];

        foreach ($jenisSampah as $jenis) {
            JenisSampah::create([
                'nama_jenis' => $jenis,
                'harga' => rand(1000, 10000),
                'status' => 'Aktif',
            ]);
        }
    }
}
