<?php

namespace Database\Factories;

use App\Models\Tabungan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryTabungan>
 */
class HistoryTabunganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionType = $this->faker->randomElement(['debit', 'kredit']);

        $debit = $transactionType === 'debit' ? $this->faker->randomNumber(5) : 0;
        $kredit = $transactionType === 'kredit' ? $this->faker->randomNumber(5) : 0;

        return [
            'tabungan_id' => $this->faker->randomElement(Tabungan::pluck('id')->toArray()),
            'debit' => $debit,
            'kredit' => $kredit,
            'keterangan' => $this->faker->word(),
        ];
    }
}
