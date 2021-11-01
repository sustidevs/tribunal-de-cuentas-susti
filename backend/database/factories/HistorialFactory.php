<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\User;
use App\Models\Historial;
use App\Models\Expediente;
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
            'expediente_id'     => Expediente::factory(),  
            'user_id'           => User::factory(),
            'area_origen_id'    => Area::factory(),
            'area_destino_id'   => Area::factory(),
            'fojas'             => $this->faker->numberBetween(1, 1000),
            'fecha'             => $this->faker->date(),
            'hora'              => $this->faker->time(),
            'estado'            => $this->faker->numberBetween(1, 3),
            'motivo'            => $this->faker->text()
        ];
    }
}
