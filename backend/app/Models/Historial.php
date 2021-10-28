<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = "historiales";

    public function area() 
    {
        return $this->morphTo();
        //return $this->hasOne('App\Models\Area');
    }

    public function user() 
    {
        return $this->hasOne('App\Models\User');
    }

    public function cuerpo() 
    {
        return $this->hasOne('App\Models\Cuerpo', 'id');
    }
}
