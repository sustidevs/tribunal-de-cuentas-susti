<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = "notificaciones";

    public function expediente()
    {
        return $this->hasOne('App\Models\Expediente', 'id', 'expediente_id');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }

    public static function index()
    {
        $notificaciones = Notificacion::all();
        $array_notificacion = collect([]);
        foreach ($notificaciones as $notificacion)
        {
            $array_notificacion->push([
                                'notificacion_id'   => $notificacion->id,
                                'nro_expediente'    => $notificacion->expediente->nro_expediente,
                                'user_id'           => $notificacion->user->id,
                                'area'              => $notificacion->user->area_id,
                                'fecha'             => $notificacion->created_at->format('d-m-Y'),
                                'estado'            => $nofitifacion->estado,
                            ]);
        }
        return $array_notificacion;
    }
}
