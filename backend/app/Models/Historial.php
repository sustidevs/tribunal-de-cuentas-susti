<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = "historiales";

    public function areaOrigen() 
    {
        return $this->hasOne('App\Models\Area','id','area_origen_id');
    }

    public function areaDestino() 
    {
        return $this->hasOne('App\Models\Area','id','area_destino_id');
    }

    public function user() 
    {
        return $this->hasOne('App\Models\User');
    }

    public function expediente() 
    {
        return $this->hasOne('App\Models\Expediente', 'id');
    }
}
