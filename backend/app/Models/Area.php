<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    //Relacion uno a muchos polimorfica
    public function historiales() 
    {
        return $this->morphMany('App\Models\Historial', 'area');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'area');
    }

    public function expedientes() 
    {
        return $this->morphMany('App\Models\Expediente', 'area_actual');
    }

    public static function all_areas(){
        $arrray_areas = collect([]);
        $areas = Area::all();
        $subareas= SubArea::all();
        
        foreach ($areas as $area) {
            $arrray_areas->push(['idd' => $area->id.'.'.$area->descripcion,
                                 'id' => $area->id,
                                 'nombre' => $area->descripcion,
                                 'tipo_area' => 'Area']);
        }

        foreach ($subareas as $subarea) {
            $arrray_areas->push(['idd' => $subarea->id.'.'.$subarea->descripcion,
                                 'id' => $subarea->id,
                                 'nombre' => $subarea->descripcion,
                                 'tipo_area' => 'Subarea']);
        }
        return $arrray_areas;
    }
}
