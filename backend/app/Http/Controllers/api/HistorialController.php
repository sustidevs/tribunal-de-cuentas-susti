<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
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
        $expediente = Expediente::findOrFail($request->expediente_id);
        $area_destino = Area::All();
        $fecha = Carbon::now()->format('d-m-Y');
        $hora = Carbon::now()->format('h:i');
        $horario = [$fecha,$hora];
        //$user = User::findOrFail($c["user_id"]);
        //$agente = [$user->persona->nombre, $user->persona->apellido, $user->id];
        $historial = [$expediente, $area_destino, $horario];
        return response()->json($historial, 200);
    }
    
    /*
    Recibe datos para registrar el pase de un cuerpo a otra área
    */
    public function store(Request $request)
    {
        $user = Auth::User(); 
        $expediente = Expediente::findOrFail($request->expediente_id);
        $historial = new Historial;
        $historial->user_id = $user->id;
        $historial->expediente_id = $expediente->id;
        $historial->area_origen_id = $user->area_id;
        $historial->area_destino_id = $request->area_destino_id;
        $historial->fojas = $request->fojas;
        $historial->fecha = Carbon::now()->format('Y-m-d');
        $historial->hora = Carbon::now()->format('h:i');
        $historial->motivo = $request->motivo;
        $historial->nombre_archivo = $request->archivo;
        $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
        $historial->save();
        return response()->json($historial, 200);
    }

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
