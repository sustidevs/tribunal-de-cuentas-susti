<?php

namespace App\Models;

use App\Models\Iniciador;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expediente extends Model
{
    use HasFactory;

    public function caratula()
    {
        return $this->hasOne('App\Models\Caratula', 'id');
    }

    public function tipoExpediente()
    {
        return $this->hasOne('App\Models\TipoExpediente','id','tipo_expediente');
    }

    public function estadoExpediente()
    {
        return $this->hasOne('App\Models\EstadoExpediente');
    }

    public function prioridadExpediente()
    {
        return $this->hasOne('App\Models\PrioridadExpediente','id','prioridad_id');
        //$this->hasOne(Phone::class, 'foreign_key', 'local_key');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function area()
    {
        //return $this->morphTo(__FUNCTION__, 'area_actual_type', 'area_actual_id');
        return $this->hasOne('App\Models\Area','id','area_actual_id');
    }

    public function historiales()
    {
        return $this->hasMany('App\Models\Historial');
    }

    public function cantidadCuerpos()
    {
        return ceil($this->fojas/200);
    }

    /*
    * Retorna una colleccion con los datos del expediente
    */
    public function getDatos()
    {
        $array = Collect(["id" => $this->id,
                          //"nro_expediente" => $this->nroExpediente($this->caratula->iniciador->prefijo, date("d-m",strtotime($this->fecha)),date("Y",strtotime($this->fecha))),
                          "nro_expediente" => $this->nro_expediente,
                          "fecha" =>  date("d-m-Y", strtotime($this->fecha)),
                          "iniciador" => $this->caratula->iniciador->nombre,
                          "cuit" => $this->caratula->iniciador->cuit,
                          "extracto" => $this->caratula->extracto->descripcion,
                          "area_actual" => $this->area->descripcion,
                          "area_actual_type" => $this->area_actual_type]);

        return $array;
    }

    public function datosExpediente()
    {
        $array = Collect(['id'=>$this->id,
                          'prioridad'=>$this->prioridadExpediente->descripcion,
                          'nro_expediente'=>$this->nro_expediente,
                          'extracto'=>$this->caratula->extracto->descripcion,
                          'fecha_creacion'=>$this->created_at->format('d-m-Y'),
                          'tramite'=>$this->tipoExpediente->descripcion,
                          'cuerpos'=>$this->cantidadCuerpos(),
                          'caratula'=>$this->caratula->id,
                          'fojas'=>$this->fojas,
                          'area_actual' => $this->area->descripcion,
                          'area_origen'=>$this->historiales->last()->areaOrigen->descripcion
            ]);

        return $array;
    }

    public static function index()
    {
        $expedientes = Expediente::all();
        $array_expediente = collect([]);
        foreach ($expedientes as $exp)
        {
            $array_expediente->push([
                                'id'=>$exp->id,
                                'prioridad'=>$exp->prioridadExpediente->descripcion,
                                'nro_expediente'=>$exp->nro_expediente,
                                'extracto'=>$exp->caratula->extracto->descripcion,
                                'fecha_creacion'=>$exp->created_at->format('d-m-Y'),
                                'tramite'=>$exp->tipoExpediente->descripcion,
                                'cuerpos'=>$exp->cantidadCuerpos(),
                                'caratula'=>$exp->caratula->id,
                                'fojas'=>$exp->fojas,
                            ]);
        }
        return $array_expediente;
    }

    public static function nroExpediente($fecha_exp, $año_exp)
    {
        $nro_aleatorio = mt_rand(1000, 9999);
        $nro_exp = Iniciador::NRO_INICIADOR . '-' . $fecha_exp . '-' . $nro_aleatorio . '/' . $año_exp;
        return $nro_exp;
    }

    public static function filtrarExpedientes($user_id,$estado,$bandeja,$array_cuerpo)
    {

        //return $user;
        //$cuerpos = Cuerpo::all();
        //$array_cuerpo = collect([]);

        // foreach ($cuerpos as $cuerpo)
        // {
        //     $array_cuerpo->push([
        //                         'prioridad'=>$cuerpo->caratula->expediente->prioridadExpediente->descripcion,
        //                         'nro_expediente'=>$cuerpo->caratula->expediente->nro_expediente,
        //                         'extracto'=>$cuerpo->caratula->extracto->descripcion,
        //                         'fecha_creacion'=>$cuerpo->caratula->expediente->created_at->format('d-m-Y'),
        //                         'tramite'=>$cuerpo->caratula->expediente->tipoExpediente->descripcion,
        //                         'cuerpos'=>$cuerpo->caratula->cuerpos()->count('id'),
        //                         'fojas'=>$cuerpo->caratula->expediente->fojas,
        //                         'cuerpo_id'=>$cuerpo->id,
        //                         "area_destino"=>$cuerpo->estadoActual()->area_destino_id,
        //                         "area_destino_type"=>$cuerpo->estadoActual()->area_destino_type,
        //                         "estado"=>$cuerpo->estadoActual()->estado,
        //                     ]);

        // }


        $user = User::findOrFail($user_id);
        //BANDEJA DE ENTRADA
        if ($bandeja == 1)
        {
            $array = Collect([]);
            foreach ($array_cuerpo as $cuerpo)
            {
                if ($cuerpo->estadoActual() != null)
                {
                    if($cuerpo->historiales->last()->area_origen_type == 'App/Models/Area')
                    {
                        $area_origen = Area::findOrFail($cuerpo->historiales->last()->area_origen_id);
                    }
                    else
                    {
                        $area_origen = SubArea::findOrFail($cuerpo->historiales->last()->area_origen_id);
                    }

                    $array->push([
                        'prioridad'=>$cuerpo->caratula->expediente->prioridadExpediente->descripcion,
                        'nro_expediente'=>$cuerpo->caratula->expediente->nro_expediente,
                        //'extracto'=>$cuerpo->caratula->extracto->descripcion,W
                        //'fecha_creacion'=>$cuerpo->caratula->expediente->created_at->format('d-m-Y'),
                        //'tramite'=>$cuerpo->caratula->expediente->tipoExpediente->descripcion,
                        //'cuerpos'=>$cuerpo->caratula->cuerpos()->count('id'),
                        'fojas'=>$cuerpo->cantidad_fojas,
                        'id_cuerpo'=>$cuerpo->id,
                        "area_destino"=>$cuerpo->estadoActual()->area_destino_id,
                        "area_destino_type"=>$cuerpo->estadoActual()->area_destino_type,
                        "estado"=>$cuerpo->estadoActual()->estado,
                        'caratula'=>$cuerpo->caratula_id,
                        'area_origen'=>$area_origen->descripcion,
                    ]);
            }

            }
            $array = $array->where('area_destino',$user->area_id)
                           ->where('area_destino_type',$user->area_type)
                           ->where('estado',$estado);
            return $array;
        }
        //BANDEJA DEL AREA
        else if($bandeja == 2)
        {
            $array = Collect([]);
            foreach ($array_cuerpo as $cuerpo)
            {

                if($cuerpo->estadoActual() != null)
                {
                    $array->push([
                        'prioridad'=>$cuerpo->caratula->expediente->prioridadExpediente->descripcion,
                        //'nro_expediente'=>$cuerpo->caratula->expediente->nro_expediente,
                        //'extracto'=>$cuerpo->caratula->extracto->descripcion,
                        //'fecha_creacion'=>$cuerpo->caratula->expediente->created_at->format('d-m-Y'),
                        //'tramite'=>$cuerpo->caratula->expediente->tipoExpediente->descripcion,
                        //'cuerpos'=>$cuerpo->caratula->cuerpos()->count('id'),
                        'fojas'=>$cuerpo->cantidad_fojas,
                        'id'=>$cuerpo->id,
                        "area_id"=>$cuerpo->area_id,
                        "area_type"=>$cuerpo->area_type,
                        "estado"=>$cuerpo->estado,
                    ]);
                }

            }

            $array = $array->where('area_id',$user->area_id)
                                         ->where('area_type',$user->area_type)
                                         ->where('estado',$estado);
            return $array;
        }
        //MI EXPEDIENTE
        else if($bandeja == 3)
        {
            $array = Collect([]);
            foreach ($array_cuerpo as $cuerpo)
            {

                if($cuerpo->estadoActual() != null)
                {
                    $array->push([
                        'prioridad'=>$cuerpo->caratula->expediente->prioridadExpediente->descripcion,
                        //'nro_expediente'=>$cuerpo->caratula->expediente->nro_expediente,
                        //'extracto'=>$cuerpo->caratula->extracto->descripcion,
                        //'fecha_creacion'=>$cuerpo->caratula->expediente->created_at->format('d-m-Y'),
                        //'tramite'=>$cuerpo->caratula->expediente->tipoExpediente->descripcion,
                        //'cuerpos'=>$cuerpo->caratula->cuerpos()->count('id'),
                        'fojas'=>$cuerpo->cantidad_fojas,
                        'id'=>$cuerpo->id,
                        "area_id"=>$cuerpo->area_id,
                        "area_type"=>$cuerpo->area_type,
                        "estado"=>$cuerpo->estado,
                        "user_id"=>$cuerpo->estadoActual()->user_id,
                    ]);
                }

            }

            $array = $array->where('area_id',$user->area_id)
                                         ->where('area_type',$user->area_type)
                                         ->where('estado',$estado)
                                         ->where('user_id',$user->id);
            return $array;
        }
        //Enviados
        else if($bandeja == 4)
        {
            $array = Collect([]);
            foreach ($array_cuerpo as $cuerpo)
            {
                if ($cuerpo->estadoActual() != null)
                {
                    $array->push([
                        'prioridad'=>$cuerpo->caratula->expediente->prioridadExpediente->descripcion,
                        'nro_expediente'=>$cuerpo->caratula->expediente->nro_expediente,
                        //'extracto'=>$cuerpo->caratula->extracto->descripcion,
                        //'fecha_creacion'=>$cuerpo->caratula->expediente->created_at->format('d-m-Y'),
                        //'tramite'=>$cuerpo->caratula->expediente->tipoExpediente->descripcion,
                        //'cuerpos'=>$cuerpo->caratula->cuerpos()->count('id'),
                        'fojas'=>$cuerpo->cantidad_fojas,
                        'id_cuerpo'=>$cuerpo->id,
                        "area_origen"=>$cuerpo->estadoActual()->area_origen_id,
                        "area_origen_type"=>$cuerpo->estadoActual()->area_origen_type,
                        "estado"=>$cuerpo->estadoActual()->estado,
                    ]);
            }

            }
            $array = $array->where('area_origen',$user->area_id)
                           ->where('area_origen_type',$user->area_type)
                           ->where('estado',$estado);
            return $array;
        }

        return "error";
    }

    public static function listadoExpedientes($user_id,$estado,$bandeja)
    {
        $Expedientes = Expediente::all();
        $user = User::findOrFail($user_id);
        $array_expediente = collect([]);
        
    
        foreach ($Expedientes as $exp)
        {
            switch ($bandeja)
            {
                case "1": #BANDEJA DE ENTRADA
                    $area_destino_id = $exp->historiales->last()->areaDestino->id;
                    $area_destino = $exp->historiales->last()->areaDestino->descripcion;
                    $estado = $exp->historiales->last()->estado;
                    break;
                case "2": #BANDEJA DEL AREA
                    $area_destino_id = $exp->area_actual_id;
                    $area_destino = $exp->area->descripcion;
                    $estado = $exp->estado_expediente_id;
                    break;
                case "3": #MI EXPEDIENTE
                    $area_destino_id = $exp->area_actual_id;
                    $area_destino = $exp->area->descripcion;
                    $estado = $exp->estado_expediente_id;
                    break;
            }

            $array_expediente->push([
                'id'=>$exp->id,
                'prioridad'=>$exp->prioridadExpediente->descripcion,
                'nro_expediente'=>$exp->nro_expediente,
                'extracto'=>$exp->caratula->extracto->descripcion,
                'fecha_creacion'=>$exp->created_at->format('d-m-Y'),
                'tramite'=>$exp->tipoExpediente->descripcion,
                'cant_cuerpos'=>$exp->cantidadCuerpos(),
                'fojas'=>$exp->fojas,
                'iniciador'=>$exp->caratula->iniciador->nombre,
                'cuit_iniciador'=>$exp->caratula->iniciador->cuit,
                'area_origen_id'=>$exp->historiales->last()->areaOrigen->id,
                'area_origen'=>$exp->historiales->last()->areaOrigen->descripcion,
                'area_destino_id'=>$area_destino_id,
                'area_destino'=>$area_destino,
                //'area_actual_id'=>$exp->area_actual_id,
                //'area_actual'=>$exp->area->descripcion,
                'estado'=>$estado,
                'user_id'=>$exp->historiales->last()->user_id
            ]);
            
        }
        /*
        * Filtro los Exp. por bandeja
        */

        #BANDEJA DE ENTRADA
        if ($bandeja == 1) {
            return $array_expediente->where('area_destino_id',$user->area_id)
            ->where('estado',$estado);
        }
        
        #BANDEJA DEL AREA
        if ($bandeja == 2) {
            return $array_expediente->where('area_destino_id',$user->area_id)
                                    ->where('estado',$estado);
        }

        #MI EXPEDIENTE
        if ($bandeja == 3) {
            return $array_expediente->where('area_destino_id',$user->area_id)
                                    ->where('user_id',$user->id)
                                    ->where('estado',$estado);
        }

        #ENVIADOS
        if ($bandeja == 4) {
            return $array_expediente->where('area_origen_id',$user->area_id)
                                    ->where('user_id',$user->id)
                                    ->where('estado',$estado);
        }
        //return $array_expediente;
    }

    public static function listadoExpedientes2($user_id,$estado,$bandeja)
    {
        $Expedientes = Expediente::all();
        $array_expediente = collect([]);
        foreach ($Expedientes as $exp)
        {
            $cuerpos_bandeja = Expediente::filtrarExpedientes($user_id,$estado,$bandeja,$exp->caratula->cuerpos);
            //return $cuerpos_bandeja->count();
            if ($cuerpos_bandeja->count() > 0)
            {

                if($exp->caratula->cuerpos->last()->historiales->last()->area_origen_type == 'App\\Models\\Area')
                {
                    $area_origen = Area::findOrFail($exp->caratula->cuerpos->last()->historiales->last()->area_origen_id);
                }
                else
                {
                    $area_origen = SubArea::findOrFail($exp->caratula->cuerpos->last()->historiales->last()->area_origen_id);
                }

                $array_expediente->push([
                    'area_origen'=>$area_origen->descripcion,
                    'id'=>$exp->id,
                    'prioridad'=>$exp->prioridadExpediente->descripcion,
                    'nro_expediente'=>$exp->nro_expediente,
                    'extracto'=>$exp->caratula->extracto->descripcion,
                    'fecha_creacion'=>$exp->caratula->expediente->created_at->format('d-m-Y'),
                    'tramite'=>$exp->tipoExpediente->descripcion,
                    'cant_cuerpos'=>$cuerpos_bandeja->count(),
                    'fojas'=>$cuerpos_bandeja->sum('fojas'),
                    'iniciador'=>$exp->caratula->iniciador->nombre,
                    'cuit_iniciador'=>$exp->caratula->iniciador->cuit,
                    'cuerpos'=>$cuerpos_bandeja,
                    //'contador'=>$contador,
                    //'fojas'=>$cuerpos_bandeja->sum(),
                    //'cuerpo_id'=>$cuerpo->id,
                    //"area_destino"=>$cuerpo->estadoActual()->area_destino_id,
                    //"area_destino_type"=>$cuerpo->estadoActual()->area_destino_type,
                    //"estado"=>$cuerpo->estadoActual()->estado,
                ]);
            }

        }
        return $array_expediente;
    }

    /*
    * Busca por nro de la tabla pagos
    */
    public static function buscarPor($valor,$busqueda)
    {
        $lista_expedientes = Collect([]);
        switch ($busqueda)
        {
            case "1": //Busca por nro_expediente
                $expediente = Expediente::where('nro_expediente', $valor)->get()->first();//Deberia retornar solo un expediente
                if ($expediente != null)
                {
                    $lista_expedientes->push($expediente->getDatos());
                }
                break;

            case "2": //Busca por cuit iniciador
                $iniciador = Iniciador::where('cuit',$valor)->get()->first();

                if ($iniciador != null)
                {
                    //Recorro las caratulas del iniciador para obtener los expedientes
                    foreach ($iniciador->caratulas as $caratula)
                    {
                        $lista_expedientes->push($caratula->expediente->getDatos());
                    }
                }
                break;
            case "3"://Busca por nro_cheque o nro_transaccion
                $pago = Pago::where('nro', $valor)->get()->first();//Deberia retornar solo un expediente
                if ($pago != null)
                {
                    $lista_expedientes->push($pago->expediente->getDatos());
                }
                break;
            case "4"://Busca por id de iniciador
                $iniciador = Iniciador::findOrFail($valor);
                //Recorro las caratulas del iniciador para obtener los expedientes
                foreach ($iniciador->caratulas as $caratula)
                {
                    $lista_expedientes->push($caratula->expediente->getDatos());
                }
                break;
        }
        return $lista_expedientes;
    }

}
