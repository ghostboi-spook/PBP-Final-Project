<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'photo_path' => null, // nanti bisa pakai gambar
            'bio' => $this->faker->paragraph(4),
            'known_for' => [
                $this->faker->words(2, true),
                $this->faker->words(2, true),
            ],
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'),
            'birth_place' => $this->faker->city . ', ' . $this->faker->country,
        ];
    }
}
