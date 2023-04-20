<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AOC>
 */
class AOCFactory extends Factory
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
            'tanggal_pemberian' => fake()->dateTime(),
            'vitamin_a' => fake()->name(),
            'obat_cacing' => (rand(1,2) == 1) ? true : false
        ];
    }
}
