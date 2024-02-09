<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'nasabah_id' => $this->faker->numberBetween(1, 10),
            'tgl_transaksi' => $this->faker->date(),
            'total_sampah' => $this->faker->numberBetween(1, 100),
            'total_berat' => $this->faker->numberBetween(1, 100),
            'total_harga' => $this->faker->numberBetween(1000, 1000000),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
