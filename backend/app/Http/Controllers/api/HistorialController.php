<?php

namespace App\Http\Controllers\api;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Historial;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHistorialRequest;

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

    /*   Datos de prueba
    {
        "expediente_id": 1,
        "user_id" : 1,
        "area_origen_id": 3,
        "area_destino_id" : 5,
        "fojas": 10,
        "motivo": "asd"
    }
    */

    /*
    * Recibe datos para registrar el pase de un expediente a otra área
    */
    public function store(StoreHistorialRequest $request)
    {
        if($request->validated())
        {
            $user = User::findOrFail($request->user_id);
            $expediente = Expediente::findOrFail($request->expediente_id);
            $historial = new Historial;
            $historial->expediente_id = $expediente->id;
            $historial->user_id = $request->user_id;
            $historial->area_origen_id = $user->area_id;
            $historial->area_destino_id = $request->area_destino_id;
            $historial->fojas = $request->fojas;
            $historial->fecha = Carbon::now()->format('Y-m-d');
            $historial->hora = Carbon::now()->format('h:i');
            $historial->observacion = $request->observacion;
            $historial->motivo = "Pase al area: " . Area::find($request->area_destino_id)->descripcion . ".";
            //$historial->nombre_archivo = $request->nombre_archivo;
            $historial->estado = 1;//pendiente para la bandeja del area destino, enviado para la bandeja origen
            $expediente->estado_expediente_id = '1';
            $expediente->fojas += $historial->fojas;
            //ARCHIVOS/////////////////////////////////////////////////////////////////////////////
            if(($request->allFiles()) != null)
            {
                $zip = new ZipArchive;
                $fileName = $expediente->nro_expediente;
                $fileName = str_replace("/","-",$fileName).'.zip';
                $path =storage_path()."/app/public/archivos_expedientes/".$fileName;
                if($zip->open($path ,ZipArchive::CREATE) === true)
                {
                    foreach ($request->allFiles() as $key => $value)
                    {
                        $relativeNameInZipFile = $value->getClientOriginalName();
                        $zip->addFile($value, $relativeNameInZipFile);
                    }
                    $zip->close();
                }
                $expediente->archivos = $fileName;
                $historial->nombre_archivo = $fileName;
                $expediente->save();
                $historial->save();
            }
            ///////////////////////////////////////////////////////////////////////////////////////
                $expediente->save();
                $historial->save();
                $area_destino = $historial->areaDestino->descripcion;
                $fecha = $historial->fecha = Carbon::now()->format('Y-m-d');
                $fojas = $historial->fojas = $request->fojas;
                $data = [
                    $area_destino,
                    $fecha,
                    $historial->hora,
                    $fojas,
                    $user->persona->nombre. " ".$user->persona->apellido,
                    $historial->observacion,
                    $expediente->nro_expediente,
                    $expediente->caratula->extracto->descripcion];
            return response()->json($data, 200);
        }
    }

     /*
    * Cambia el estado de los cuerpos de un expediente y guarda registro del mismo en el historial.
    */
    public function updateEstado(Request $request)
    {
        # 1-Enviado/Pendiente, 3-Aceptado, 4-Recuperado
        $user = User::findOrFail($request->user_id);//$user = Auth::user();
        $expediente = Expediente::findOrFail($request->expediente_id);

        $historial = new Historial;
        $historial->expediente_id = $expediente->id;
        $historial->user_id = $user->id;
        $historial->area_origen_id = $expediente->historiales->last()->area_origen_id;
        $historial->area_destino_id = $user->area_id;
        $historial->fojas = $expediente->historiales->last()->fojas;
        $historial->fecha = Carbon::now()->format('Y-m-d');
        $historial->hora = Carbon::now()->format('h:i');
        $historial->motivo = "Pase aceptado";
        $historial->estado = $request->estado_expediente;
        $expediente->estado_expediente_id = $request->estado_expediente;
        /*
        * Si el estado al que cambia es 3 (mis expediente), Actualizo el area actual del expediente.
        */
        if ($request->estado_expediente == 3) {
            $expediente->area_actual_id = $user->area_id;
            $expediente->update();
        }
        else
        {
            $expediente->update();
        }

        $historial->save();

        $estado = $request->estado;//parametro
        $bandeja = $request->bandeja;
        $user_id = $request->user_id;
        $listado_expedientes = Expediente::listadoExpedientes($user_id,$estado,$bandeja);
        return response()->json($listado_expedientes,200);

        /*   Datos de prueba
        {
            "expediente_id": 1,
            "user_id" : 1,
            "estado_expediente": 3,
            "estado" : 3,
            "bandeja": 3
        }
        */
    }

    /*
    *   Trae el historial completo de un expediente.
    */
    public function historialExpediente(Request $request)
    {
        $expediente = Expediente::findOrFail($request->id);
        $array = collect([]);
        foreach ($expediente->historiales as $historial)
        {
                $array->push($historial->getHistorial());
        }
        return response()->json($array, 200);
    }

    /*
    * Devuelve los expedientes enviados de un usuario
    */
    public function misEnviados(Request $request)
    {
        if ($request->user_id != null){
            $misExpEnviados = Historial::ExpedientesEnviados($request->area_id,$request->user_id);
        }
        else{ //Si user_id == null  trae todos los Exp. Enviados del area
            $misExpEnviados = Historial::ExpedientesEnviados($request->area_id);
        }
       
        return response()->json($misExpEnviados, 200);

        /*   Datos de prueba
        {
            "user_id" : 1,
            "area_id": 13,
        }
        */
    }
}
