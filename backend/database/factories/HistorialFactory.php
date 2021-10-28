<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\User;
use App\Models\Cuerpo;
use App\Models\SubArea;
use App\Models\Historial;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $areaOrigen = Area::factory();
        $areaDestino = Area::factory();
        return [
            'cuerpo_id'         => Cuerpo::factory(),
            'user_id'           => User::factory(),
            'area_origen_id'    => SubArea::factory(),
            'area_destino_id'   => Area::factory(),
            'area_origen_type'  => $this->faker->randomElement(['App\Models\SubArea']),
            'area_destino_type' => $this->faker->randomElement(['App\Models\Area']),
            'fojas'             => $this->faker->numberBetween(1, 1000),
            'fecha'             => $this->faker->date(),
            'hora'              => $this->faker->time(),
            'estado'            => $this->faker->numberBetween(1, 3),
            'motivo'            => $this->faker->text()
        ];
    }
}
