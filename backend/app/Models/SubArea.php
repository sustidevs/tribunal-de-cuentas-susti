<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    use HasFactory;

    public function area() 
    {
        return $this->hasOne('App\Models\SubArea');
    }

    public function cuerpos()
    {
        return $this->hasMany('App\Models\Cuerpos');
    }

    //Relacion uno a muchos polimorfica
    public function historiales() 
    {
        return $this->morphMany('App\Models\Historial', 'area');
    }

    public function expedientes() 
    {
        return $this->morphMany('App\Models\Expediente', 'area_actual');
    }

    public function user()
    {
        return $this->morphOne('App\Models\User', 'area');
    }

}
