<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caratula extends Model
{
    use HasFactory;

    public function expediente() 
    {
        return $this->belongsTo('App\Models\Expediente');
    }

    public function responsable() 
    {
        return $this->hasOne('App\Models\Responsable');
    }

    public function extracto() 
    {
        return $this->hasOne('App\Models\Extracto','id','extracto_id');
    }

    public function iniciador()
    {
        return $this->hasOne('App\Models\Iniciador', 'id', 'iniciador_id');
    }
}
