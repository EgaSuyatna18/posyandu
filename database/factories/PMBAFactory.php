<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PMBA>
 */
class PMBAFactory extends Factory
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
            'umur' => rand(1, 10),
            'tanggal' => fake()->dateTime(),
            'nasihat' => fake()->text(5)
        ];
    }
}
