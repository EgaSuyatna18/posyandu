<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anak>
 */
class AnakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->randomNumber(5, true),
            'ibu_id' => rand(1, 10),
            'nama_anak' => fake()->name(),
            'tanggal_lahir' => fake()->dateTime(),
            'jenis_kelamin' => (rand(1, 2) == 1) ? 'Laki-laki' : 'Perempuan',
            'bb' => fake()->randomDigit(),
            'pb' => fake()->randomDigit()
        ];
    }
}
