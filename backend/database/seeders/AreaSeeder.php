<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{

    Private $arrayAreas = array (
        array('descripcion' => 'SECRETARIA GENERAL TECNICA'),
        array('descripcion' => 'SECRETARIA GENERAL ADMINISTRATIVA'),
        array('descripcion' => 'ASESORIA LETRADA'),
        array('descripcion' => 'DIRECCION DE PERSONAL'),
        array('descripcion' => 'DIRECCION DE ADMINISTRACION'),
        array('descripcion' => 'DIRECCION DE REGISTRACIONES E INFORMATICA'),
        array('descripcion' => 'VOCALIAS' )
    );

    Private $arraySubAreas = array (
        array('descripcion' => 'Dpto. FALLOS'),
        array('descripcion' => 'ARCHIVO'),
        array('descripcion' => 'PROSECRETARIA'),
        array('descripcion' => 'Dpto. NOTIFICACION'),
        array('descripcion' => 'MAYORDOMIA'),
        array('descripcion' => 'Dpto. MESA DE ENTRADAS Y SALIDAS'),
        array('descripcion' => 'Dpto. TESORERIA'),
        array('descripcion' => 'Dpto. CONTABLE'),
        array('descripcion' => 'Dpto. INFORMATICA'),
        array('descripcion' => 'RELATORES'),
        array('descripcion' => 'FISCALIZADORES'),
        array('descripcion' => 'AUDITORES'),
        array('descripcion' => 'AUXILIAR DE AUDITORIA')
        //último sin coma
        );

    public function run()
    {
        //DB::table('areas')->delete();
        foreach ($this->arrayAreas as $a)
        {
            $area = new Area();
            $area->descripcion = $a['descripcion'];
            $area->save();
        }

        foreach ($this->arraySubAreas as $s_a)
        {
            $sub_area = new Area();
            $sub_area->descripcion = $s_a['descripcion'];
            $sub_area->save();
        }
    }

}
