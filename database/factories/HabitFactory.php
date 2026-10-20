<?php

namespace Database\Factories;

use App\Models\Habit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habits = [
            "Ler 10 páginas de um livro",
            "Fazer 30 minutos de exercício físico",
            "Meditar por 15 minutos",
            "Escrever no diário",
            "Aprender uma nova palavra em outro idioma"
        ];

        return [
            'user_id' => 1,
            'name' => $this->faker->unique()->randomElement($habits),
        ];
    }
}
