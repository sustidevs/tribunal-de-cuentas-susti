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
        return $this->hasOne('App\Models\Expediente', 'id', 'expediente_id');
    }

    public function getHistorial()
    {
        $array=Collect([
            'expediente_id'     =>$this->expediente->id,
            'nro_expediente'    =>$this->expediente->nro_expediente,
            'extracto'          =>$this->expediente->caratula->extracto->descripcion,
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

    /*
    * Devuelve todos los expedientes enviados de un usuario
    *
    */
    public static function ExpedientesEnviados($area_id,$user_id = 0)
    {
        $array = Collect();

        $historiales = Historial::all()->where("area_origen_id",$area_id);
        #Si $user_id == 0 (parametro opcional) trae todos los expedientes filtrados solo por area.
        if ($user_id > 0){
            $historiales = $historiales->where("user_id",$user_id);
        }
                                       
    #ACLARACION: Hago este filtro porque cuando el area_destino_id = area_origen_id significa que no se realizo ningun pase (o se envio) el exp,
    #sino que solo se cambio el estado:
        $historiales = $historiales->where("area_destino_id","!=", $area_id ); 
        
        foreach($historiales as $historial){
            $array->push($historial->getHistorial());
        }
        return $array;
    }

}
