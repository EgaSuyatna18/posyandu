<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Imunisasi>
 */
class ImunisasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'anak_id' => rand(1, 10),
            'vaksin_id' => rand(1, 10),
            'umur' => rand(1, 10),
            'tanggal_imunisasi' => fake()->dateTime()
        ];
    }
}
