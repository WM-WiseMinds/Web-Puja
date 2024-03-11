<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nasabah>
 */
class NasabahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->randomElement(User::pluck('id')->toArray()),
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->phoneNumber,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'foto' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
