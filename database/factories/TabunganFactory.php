<?php

namespace Database\Factories;

use App\Models\Nasabah;
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
            'nasabah_id' => Nasabah::factory(),
            'debit' => $this->faker->randomNumber(5),
            'kredit' => $this->faker->randomNumber(5),
            'saldo' => $this->faker->randomNumber(5),
            'keterangan' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
