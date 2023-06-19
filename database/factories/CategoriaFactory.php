<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->unique()->categoria()
        ];
    }
}
