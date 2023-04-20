<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyuluhan>
 */
class PenyuluhanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kader_id' => rand(1, 10),
            'tanggal_penyuluhan' => fake()->dateTime(),
            'materi' => fake()->text(5),
            'media' => fake()->text(5),
            'dokumentasi' => 'faker',
        ];
    }
}
