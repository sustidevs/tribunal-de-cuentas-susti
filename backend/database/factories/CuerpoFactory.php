<?php

namespace Database\Factories;

use App\Models\Cuerpo;
use App\Models\Caratula;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuerpoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cuerpo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cantidad_fojas' => $this->faker->numberBetween(1, 200),
            'caratula_id' => Caratula::factory(),
            'estado' => $this->faker->numberBetween(0, 1),
            'area_id' => $this->faker->numberBetween(1, 7),
            'area_type' => $this->faker->randomElement(['App\Models\Area','App\Models\SubArea'])
        ];
    }
}
