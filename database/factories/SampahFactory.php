<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sampah>
 */
class SampahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaksi_id' => $this->faker->randomElement(Transaksi::pluck('id')->toArray()),
            'jenis_sampah' => $this->faker->word(),
            'nama_sampah' => $this->faker->word(),
            'harga_sampah' => $this->faker->numberBetween(1000, 1000000),
            'jumlah_sampah' => $this->faker->numberBetween(1, 100),
        ];
    }
}
