<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Cuerpo;
use App\Models\Historial;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistorialController extends Controller
{
    public function create(Request $request)
    {
        $expediente = Expediente::findOrFail($request->id);
        //$cuerpos_pase = Collect([]);
        //$cuerpos_pase = $request->cuerpos;
        //$nro_cuerpos = count($request->cuerpos);
        //$fojas = 0;
        //for ($x=1;$x<=$nro_cuerpos; $x++)
        //{
        //    $c = $request->cuerpos[$x];
        //    $fojas = $fojas + $c["fojas"];
        //} 
        $area_destino = Area::all_areas();
        $fecha = Carbon::now()->format('d-m-Y');
        $hora = Carbon::now()->format('h:i');
        $horario = [$fecha,$hora];
        //$user = User::findOrFail($c["user_id"]);
        //$agente = [$user->persona->nombre, $user->persona->apellido, $user->id];
        //$pase = [$fojas,$fecha,$hora,$agente,$cuerpos_pase,$areaDestino];
        $pase = [$expediente, $area_destino, $horario];
        return response()->json($pase, 200);
    }

    /*ejemplo con dos cuerpos, para el postman
    {
        "cuerpos": {
          "1": {
            "prioridad": "media",
            "fojas": 100,
            "id": 12,
            "area_id": 6,
            "area_type": "App\\Models\\SubArea",
            "estado": 3,
            "user_id": 22
          },
          "2": {
            "prioridad": "media",
            "fojas": 100,
            "id": 12,
            "area_id": 6,
            "area_type": "App\\Models\\SubArea",
            "estado": 3,
            "user_id": 22
          }
        }
    }
    */

    /*
    Recibe datos para registrar el pase de un cuerpo a otra área
    */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id); // TODO REEMPLAZAR
        $ultimo_cuerpo = Expediente::findOrFail($request->expediente_id)->caratula->cuerpos->last()->estadoActual();
        $fojas_ultimo_cuerpo = $ultimo_cuerpo->fojas;
        $fojas_total = $fojas_ultimo_cuerpo + $request->fojas;
        if ($fojas_total <= Cuerpo::CANTIDAD_FOJAS)
        {
            $ultimo_cuerpo = Expediente::findOrFail($request->expediente_id)->caratula->cuerpos->last();//Cuerpo
            $ultimo_cuerpo->cantidad_fojas = $fojas_total;
            $ultimo_cuerpo->save();
            $act_historial = $ultimo_cuerpo->estadoActual();//Historial
            $act_historial->fojas = $fojas_total;
            $act_historial->area_origen_id = $user->area_id;
            $act_historial->area_origen_type = $user->area_type;
            $act_historial->area_destino_id = $request->area_destino_id;
            $act_historial->area_destino_type = $request->area_destino_type;
            $act_historial->fecha = Carbon::now()->format('Y-m-d');
            $act_historial->hora = Carbon::now()->format('h:i');
            $act_historial->motivo = $request->motivo;
            $act_historial->archivo = $request->archivos;
            $act_historial->estado = 1;
            $act_historial->save();

            // $historial = new Historial;
            // $historial->cuerpo_id = $ultimo_cuerpo->cuerpo_id;
            // $historial->user_id = $user->id;
            // $historial->fojas = $fojas_total;
            // $historial->area_origen_id = $user->area_id;
            // $historial->area_origen_type = $user->area_type;
            // $historial->area_destino_id = $request->area_destino_id;
            // $historial->area_destino_type = $request->area_destino_type;
            // $historial->fecha = Carbon::now()->format('Y-m-d');
            // $historial->hora = Carbon::now()->format('h:i');
            // $historial->motivo = $request->motivo;
            // $historial->archivo = $request->archivos;
            // $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
            // $historial->save();
        }
        else
        {
            do
            {
                
                $ultimo_cuerpo = Expediente::findOrFail($request->expediente_id)->caratula->cuerpos->last();//Cuerpo
                $ultimo_cuerpo->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
                $ultimo_cuerpo->estado = 1;
                $ultimo_cuerpo->save();
                $act_historial = $ultimo_cuerpo->estadoActual();//Historial
                $act_historial->fojas = $ultimo_cuerpo->cantidad_fojas;
                $act_historial->estado =1;
                $act_historial->save();
                //SE ACTUALIZO EL NUMERO DE FOJAS DEL ULTIMO CUERPO Y DEL ULTIMO HISTORIAL DE ESE CUERPO

                $dif = $fojas_total - Cuerpo::CANTIDAD_FOJAS;

                if($dif > Cuerpo::CANTIDAD_FOJAS)
                {
                    $cuerpo = new Cuerpo;
                    $cuerpo->caratula_id = $ultimo_cuerpo->caratula_id;
                    $cuerpo->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                    $cuerpo->area_id = $ultimo_cuerpo->area_id;
                    $cuerpo->area_type = $ultimo_cuerpo->area_type;
                    $cuerpo->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
                    $cuerpo->save();
                    $historial = new Historial;
                    $historial->cuerpo_id = $cuerpo->id;
                    $historial->user_id = $user->id;
                    $historial->fojas = Cuerpo::CANTIDAD_FOJAS;
                    $historial->area_origen_id = $user->area_id;
                    $historial->area_origen_type = $user->area_type;
                    $historial->area_destino_id = $request->area_destino_id;
                    $historial->area_destino_type = $request->area_destino_type;
                    $historial->fecha = Carbon::now()->format('Y-m-d');
                    $historial->hora = Carbon::now()->format('h:i');
                    $historial->motivo = $request->motivo;
                    $historial->archivo = $request->archivos;
                    $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                    $historial->save();
                    $dif = $dif - Cuerpo::CANTIDAD_FOJAS;
                    if($dif <= Cuerpo::CANTIDAD_FOJAS)
                    {
                        $cuerpo = new Cuerpo;
                        $cuerpo->caratula_id = $ultimo_cuerpo->caratula_id;
                        $cuerpo->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                        $cuerpo->area_id = $ultimo_cuerpo->area_id;
                        $cuerpo->area_type = $ultimo_cuerpo->area_type;
                        $cuerpo->cantidad_fojas = $dif;
                        $cuerpo->save();
                        $historial = new Historial;
                        $historial->cuerpo_id = $cuerpo->id;
                        $historial->user_id = $user->id;
                        $historial->fojas = $dif;
                        $historial->area_origen_id = $user->area_id;
                        $historial->area_origen_type = $user->area_type;
                        $historial->area_destino_id = $request->area_destino_id;
                        $historial->area_destino_type = $request->area_destino_type;
                        $historial->fecha = Carbon::now()->format('Y-m-d');
                        $historial->hora = Carbon::now()->format('h:i');
                        $historial->motivo = $request->motivo;
                        $historial->archivo = $request->archivos;
                        $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                        $historial->save();
                    }
                }
                else if ($dif <= Cuerpo::CANTIDAD_FOJAS)
                {
                    $cuerpo = new Cuerpo;
                    $cuerpo->cantidad_fojas = $dif;//probar con $fojas_total
                    $cuerpo->caratula_id = $ultimo_cuerpo->caratula_id;//Cuerpo::findOrFail($ultimo_cuerpo->cuerpo_id)->caratula->id;//$ultimo_cuerpo->cuerpo->caratula_id;
                    $cuerpo->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                    $cuerpo->area_id = $ultimo_cuerpo->area_id;
                    $cuerpo->area_type = $ultimo_cuerpo->area_type;
                    $cuerpo->save();
                    $historial = new Historial;
                    $historial->cuerpo_id = $cuerpo->id;
                    $historial->user_id = $user->id;
                    $historial->fojas = $dif;
                    $historial->area_origen_id = $user->area_id;
                    $historial->area_origen_type = $user->area_type;
                    $historial->area_destino_id = $request->area_destino_id;
                    $historial->area_destino_type = $request->area_destino_type;
                    $historial->fecha = Carbon::now()->format('Y-m-d');
                    $historial->hora = Carbon::now()->format('h:i');
                    $historial->motivo = $request->motivo;
                    $historial->archivo = $request->archivos;
                    $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
                    $historial->save();
                }
            }
            while($dif>= 201);
        }
        $test = ['holas'];
        return response()->json($test, 200);
     }

        // foreach($cuerpos as $cuerpo)
        // {
        //     $historial = new Historial;
        //     $historial->cuerpo_id = $cuerpo->id;
        //     $historial->user_id = $user->id;
        //     $historial->area_origen_id = $cuerpo->area_id;
        //     $historial->area_destino_id = $request->area_destino_id;
        //     $historial->area_orirgen_type = $cuerpo->area_type;
        //     $historial->area_destino_type = $request->area_destino_type;
        //     $historial->fojas = 
        // }
        //$historial = new Historial;
        //$historial->cuerpo_id = $request->cuerpo_id;
        //$historial->user_id = $user->id;
        //$historial->area_origen_id = $user->area_id;
        //$historial->area_destino_id = $request->area_destino_id;
        //$historial->area_origen_type = $user->area_type;
        //$historial->area_destino_type = $request->area_destino_type;
        //$historial->fojas = $request->fojas;
        //$historial->fecha = Carbon::now()->format('Y-m-d');
        //$historial->hora = Carbon::now()->format('h:i');
        //$historial->motivo = $request->motivo;
        //$historial->estado = $request->estado;
        //$historial->archivos = $request->archivos;
        //$historial->save();       

        //$fojas_total = $cuerpo->cantidad_fojas + $request->fojas;

        //if($fojas_total > Cuerpo::CANTIDAD_FOJAS)
        //{
        //    if($cuerpo->cantidad_fojas < Cuerpo::CANTIDAD_FOJAS)
        //    {
        //        $fojas_total -= Cuerpo::CANTIDAD_FOJAS;
        //        $cuerpo->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
        //        $cuerpo->update();
        //    }
        //    while($fojas_total > 0)
        //    {
        //        $nuevo_cuerpo = new Cuerpo;
        //        if($fojas_total > Cuerpo::CANTIDAD_FOJAS)
        //        {
        //             $nuevo_cuerpo->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
        //             $fojas_total -= Cuerpo::CANTIDAD_FOJAS;
        //         }
        //         else
        //         {
        //             $nuevo_cuerpo->cantidad_fojas = $fojas_total;
        //             $fojas_total -= Cuerpo::CANTIDAD_FOJAS;
        //         }                
        //         $nuevo_cuerpo->caratula_id = $cuerpo->caratula_id;
        //         $nuevo_cuerpo->estado = 1;
        //         $nuevo_cuerpo->save();                              
        //     }
        // }
        // else
        // {
        //     $cuerpo->cantidad_fojas = $fojas_total;
        //     $cuerpo->update();
        // }
        //$test = ['holas'];
        //return response()->json($test, 200);
    //}

     /*
    * Cambia el estado de los cuerpos de un expediente y guarda registro del mismo en el historial.
    */
    public function updateEstado(Request $request)
    {
        /*
        $data = Cuerpo::listadoExpedientes();//Metodo de Agustin

        $request = new Request;
        $request->estado_expediente = '2'; // 1-Enviado/Pendiente, 2-Aceptado, 3-Asignado, 4-Recuperado 
        */

        /*
        * Recorre los cuerpos del expediente. (puede cambiar depende de como retorne los datos $request->expediente) 
        */
        foreach ($request->cuerpos as $c) {
            $user = User::findOrFail($request->user_id);//$user = Auth::user();
            //obtendo el cuerpo, actualizo su estado y creo un historial 
            $cuerpo = Cuerpo::findOrFail($c["id_cuerpo"]);
            $cuerpo->estado = $request->estado_expediente;
            $historial = new Historial;
            $historial->cuerpo_id = $cuerpo->id;
            $historial->user_id = $user->id;
            $historial->area_origen_id = $user->area_id;
            $historial->area_origen_type = $user->area_type;
            $historial->area_destino_id = $user->area_id;
            $historial->area_destino_type = $user->area_type;
            $historial->fojas = $cuerpo->cantidad_fojas;
            $historial->fecha = Carbon::now()->format('Y-m-d');
            $historial->hora = Carbon::now()->format('h:i');
            $historial->motivo = "cambio estado";
            $historial->estado = $request->estado_expediente;

            /*
            * Si el estado al que cambia es 3 (mis expediente), Actualizo el area actual del cuerpo. 
            */
            if ($request->estado_expediente == 3) {
                $cuerpo->area_id = $user->area_id;
                $cuerpo->area_type = $user->area_type;
                $cuerpo->update();  
            }
            else{
                $cuerpo->update(); 
            }
            
            $historial->save();
        }
    
        $estado = $request->estado;//parametro
        $bandeja = $request->bandeja;
        $user_id = $request->user_id;
        $listado_expedientes = Expediente::listadoExpedientes($user_id,$estado,$bandeja);
        return response()->json($listado_expedientes,200);     
    }
    /*
    *   Trae el historial completo de un expediente.
    */
    public function historialExpediente(Request $request)
    {
        $historiales = Historial::All();
        $array = collect([]);
        foreach ($historiales as $historial)
        {
            if($historial->cuerpo->caratula->expediente->nro_expediente == $request->nro_expediente)
            {
                $array->push([
                    'data' => $historial->cuerpo->caratula->expediente->nro_expediente
                ]);
            }
        }
        return response()->json($array, 200);
    }
}
