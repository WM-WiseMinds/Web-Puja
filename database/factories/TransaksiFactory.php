<?php

namespace Database\Factories;

use App\Models\Nasabah;
use App\Models\User;
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
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'nasabah_id' => $this->faker->randomElement(Nasabah::pluck('id')->toArray()),
            'total_sampah' => $this->faker->numberBetween(1, 100),
            'total_harga' => $this->faker->numberBetween(1000, 1000000),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
