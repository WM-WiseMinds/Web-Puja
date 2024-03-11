<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1;

        return [
            'nama_barang' => 'Barang ' . chr(64 + $counter++),
            'harga_barang' => $this->faker->randomNumber(3) * 100,
            'stok_barang' => $this->faker->randomNumber(2),
            'gambar_barang' => $this->faker->imageUrl(),
            'keterangan' => $this->faker->text,
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
