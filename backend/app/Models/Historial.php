<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(User::class);
    }

    public function expediente() 
    {
        return $this->hasOne('App\Models\Expediente', 'id');
    }

    public function getHistorial()
    {
        $array=Collect([
            'expediente_id'     =>$this->expediente->id,
            'nro_expediente'     =>$this->expediente->nro_expediente,
            'area_origen_id'    =>$this->areaOrigen->id,
            'area_origen'       =>$this->areaOrigen->descripcion,
            'area_destino_id'   =>$this->areaDestino->id,
            'area_destino'      =>$this->areaDestino->descripcion,
            'user_id'           =>$this->user->id,
            'nombre_usuario'    =>$this->user->persona->nombre . ", " . $this->user->persona->apellido,
            'fecha'             =>date("d-m-Y", strtotime($this->fecha)),
            'motivo'            =>$this->motivo
        ]);
        return $array;
    }
}
