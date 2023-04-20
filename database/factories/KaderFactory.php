<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kader>
 */
class KaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kader' => fake()->name(),
            'alamat' => fake()->text(5),
            'no_telepon' => fake()->randomNumber(5, true)
        ];
    }
}
