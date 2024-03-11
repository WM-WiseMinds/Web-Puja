<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisSampah>
 */
class JenisSampahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_sampah' => $this->faker->randomElement(['Organik', 'Anorganik', 'B3', 'Non B3', 'Lainnya']),
            'harga_sampah' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
