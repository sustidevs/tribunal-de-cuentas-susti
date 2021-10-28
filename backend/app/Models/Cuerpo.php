<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuerpo extends Model
{
    use HasFactory;
    const CANTIDAD_FOJAS = 200;

    public function caratula() 
    {
        return $this->belongsTo('App\Models\Caratula');
    }

    public function historiales() 
    {
        return $this->hasMany('App\Models\Historial');
    }

    public function estadoActual()
    {
        $estado_actual_cuerpo = collect([]);
        $estado_actual_cuerpo->push($this->historiales->sortBy("created_at")->last());
        return $estado_actual_cuerpo->first();
    }

}
