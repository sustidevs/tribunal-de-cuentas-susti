<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubAreaSeeder extends Seeder
{

    Private $arrayAreas = array (
        array('descripcion' => 'SECRETARIA GENERAL TECNICA' ,'admin_area' =>                 1),
        array('descripcion' => 'SECRETARIA GENERAL ADMINISTRATIVA' ,'admin_area' =>          2),
        array('descripcion' => 'ASESORIA LETRADA' ,'admin_area' =>                           3),
        array('descripcion' => 'DIRECCION DE PERSONAL' ,'admin_area' =>                      4),
        array('descripcion' => 'DIRECCION DE ADMINISTRACION' ,'admin_area' =>                5),
        array('descripcion' => 'DIRECCION DE REGISTRACIONES E INFORMATICA' ,'admin_area' =>  6),
        array('descripcion' => 'VOCALIAS' ,'admin_area' =>                                   7)
    );

    Private $arraySubAreas = array (
        array('area_id' => 1 ,'descripcion' => 'Dpto. FALLOS', 'admin_subArea' =>                       8 ),
        array('area_id' => 1 ,'descripcion' => 'ARCHIVO', 'admin_subArea' =>                            9 ),
        array('area_id' => 2 ,'descripcion' => 'PROSECRETARIA', 'admin_subArea' =>                      10 ),
        array('area_id' => 2 ,'descripcion' => 'Dpto. NOTIFICACION', 'admin_subArea' =>                 11 ),
        array('area_id' => 2 ,'descripcion' => 'MAYORDOMIA', 'admin_subArea' =>                         12 ),
        array('area_id' => 2 ,'descripcion' => 'Dpto. MESA DE ENTRADAS Y SALIDAS', 'admin_subArea' =>   13 ),
        array('area_id' => 5 ,'descripcion' => 'Dpto. TESORERIA', 'admin_subArea' =>                    14 ),
        array('area_id' => 5 ,'descripcion' => 'Dpto. CONTABLE', 'admin_subArea' =>                     15 ),
        array('area_id' => 6 ,'descripcion' => 'Dpto. INFORMATICA', 'admin_subArea' =>                  16 ),
        array('area_id' => 7 ,'descripcion' => 'RELATORES', 'admin_subArea' =>                          17 ),
        array('area_id' => 7 ,'descripcion' => 'FISCALIZADORES', 'admin_subArea' =>                     18 ),
        array('area_id' => 7 ,'descripcion' => 'AUDITORES', 'admin_subArea' =>                          19 ),
        array('area_id' => 7 ,'descripcion' => 'AUXILIAR DE AUDITORIA', 'admin_subArea' =>              20 )
        //último sin coma
        );

    public function run()
    {
        User::factory()->count(20)->create(['tipo_user_id'=>1]);
        //DB::table('areas')->delete();
        foreach ($this->arrayAreas as $a)
        {
            $area = new Area();
            $area->descripcion = $a['descripcion'];
            $area->admin_area = $a['admin_area'];
            $area->save();
        }

        //DB::table('sub_areas')->delete();
        foreach ($this->arraySubAreas as $s_a)
        {
            $sub_area = new SubArea();
            $sub_area->area_id = $s_a['area_id'];
            $sub_area->admin_subArea = $s_a['admin_subArea'];
            $sub_area->descripcion = $s_a['descripcion'];
            $sub_area->save();
        }
    }

}
