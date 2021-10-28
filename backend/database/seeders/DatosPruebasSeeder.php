<?php

namespace Database\Seeders;


use App\Models\Area;
use App\Models\User;
use App\Models\Cuerpo;
use App\Models\Historial;
use App\Models\SubArea;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatosPruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
            $h = new Historial();
            $h->cuerpo_id = Cuerpo::factory()->count(1)->create()->first()->id;
            $h->user_id = 22;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->area_origen_type = 'App\Models\SubArea';
            $h->area_destino_type = 'App\Models\SubArea';
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();

            $h = new Historial();
            $h->cuerpo_id = Cuerpo::factory()->count(1)->create()->first()->id;
            $h->user_id = 22;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->area_origen_type = 'App\Models\SubArea';
            $h->area_destino_type = 'App\Models\SubArea';
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();

            $h = new Historial();
            $h->cuerpo_id = Cuerpo::factory()->count(1)->create()->first()->id;
            $h->user_id = 22;
            $h->area_origen_id = 7;
            $h->area_destino_id = 6;
            $h->area_origen_type = 'App\Models\SubArea';
            $h->area_destino_type = 'App\Models\SubArea';
            $h->fojas = 200;
            $h->fecha = '1993-03-29';
            $h->hora = '18:13:31';
            $h->estado = 1;
            $h->motivo = 'asdasdas';
            $h->save();
    }
}