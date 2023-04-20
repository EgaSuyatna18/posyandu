<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ibu>
 */
class IbuFactory extends Factory
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
            'nama_istri' => fake()->name(),
            'tanggal_lahir' => fake()->dateTime(),
            'alamat' => fake()->text(5),
            'telepon' => fake()->randomNumber(5, true),
            'golongan_darah' => 'A',
            'nama_suami' => fake()->name()
        ];
    }
}
