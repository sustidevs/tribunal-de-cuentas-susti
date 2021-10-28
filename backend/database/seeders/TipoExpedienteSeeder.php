<?php

namespace Database\Seeders;

use App\Models\TipoExpediente;
use Illuminate\Database\Seeder;

class TipoExpedienteSeeder extends Seeder
{
    
    private $arrayTipoExpedientes = array(
        array('descripcion' => 'FONDO PERMANENTE','numero' => '1000'),
        array('descripcion' => 'CANCELACIÓN','numero' => '2000'),
        array('descripcion' => 'SUBSIDIO','numero' => '3000'),
        array('descripcion' => 'APORTE NO REINTEGRABLE','numero' => '4000'),
        array('descripcion' => 'BALANCES','numero' => '5000'),
        array('descripcion' => 'MEMORIAS','numero' => '6000'),
        array('descripcion' => 'ACORDADA Nº32/2001','numero' => '7000'),
        array('descripcion' => 'ACORDADA Nº17/2003','numero' => '8000'),
        array('descripcion' => 'ACORDADA 08/2005','numero' => '9000'),
        array('descripcion' => 'ACORDADA 12/2005','numero' => '10000'),
        array('descripcion' => 'NOTAS','numero' => '11000'),
        array('descripcion' => 'CUENTA DE INVERSION','numero' => '12000'),
        array('descripcion' => 'ACORDADA 222/2011','numero' => '13000'),
        array('descripcion' => 'ARANCELAMIENTO','numero' => '14000'),
        array('descripcion' => 'ACORDADA 229/2011','numero' => '15000'),
        array('descripcion' => 'FONDO FEDERAL SOLIDARIO','numero' => '16000'),
        array('descripcion' => 'REQUERIMIENTO','numero' => '17000'),
        array('descripcion' => 'OFICIO','numero' => '18000'),
        array('descripcion' => 'FO.E.SE','numero' => '19000'),
        array('descripcion' => 'ACORDADA 404/2016','numero' => '20000'),
        array('descripcion' => 'ACORDADA 222/2011','numero' => '21000'),
        array('descripcion' => 'SUELDOS','numero' => '22000'),
        array('descripcion' => 'CEDULAS DE REGISTRACIONES','numero' => '23000'),
    );

    public function run()
    {
        foreach($this->arrayTipoExpedientes as $tipo){
            $t = new TipoExpediente();
            $t->descripcion = $tipo['descripcion'];
            $t->nro_tipo_exp = $tipo['numero'];
            $t->save();
        }
    }
}
