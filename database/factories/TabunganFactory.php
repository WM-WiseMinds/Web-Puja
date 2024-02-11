<?php

namespace Database\Factories;

use App\Models\Nasabah;
use App\Models\Tabungan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tabungan>
 */
class TabunganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'saldo' => $this->faker->randomNumber(5),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
