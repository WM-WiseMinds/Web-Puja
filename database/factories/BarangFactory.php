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
        return [
            'nama_barang' => $this->faker->word,
            'harga_barang' => $this->faker->randomNumber(5),
            'stok_barang' => $this->faker->randomNumber(2),
            'gambar_barang' => $this->faker->imageUrl(),
            'keterangan' => $this->faker->text,
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
