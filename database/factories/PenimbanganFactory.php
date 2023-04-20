<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penimbangan>
 */
class PenimbanganFactory extends Factory
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
            'bulan' => rand(1, 10),
            'tanggal_timbang' => fake()->dateTime(),
            'umur' => rand(1, 50),
            'bb' => rand(1, 10),
            'pb' => rand(1, 10),
            'lk' => rand(1, 10),
        ];
    }
}
