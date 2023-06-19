<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{

    public function definition()
    {
        return [
            'nome'         => $this->faker->text(255),
            'quantidade'   => $this->faker->randomNumber(),
            'categoria_id' => $this->faker->numberBetween(1, Categoria::count())
        ];
    }
}
