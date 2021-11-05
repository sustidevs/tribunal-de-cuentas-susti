<?php

namespace App\Http\Controllers\api;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Caratula;
use App\Models\Extracto;
use App\Models\Historial;
use App\Models\Iniciador;
use App\Models\Expediente;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;
use App\Models\TipoExpediente;
use App\Models\PrioridadExpediente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreExpedienteRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{

    public function index()
    {
        $expediente = Expediente::index();
        return response()->json($expediente,200);
    }

    public function create()
    {
        $motivo = TipoExpediente::motivosConExtractos();
        $motivoAll = TipoExpediente::all();
        $iniciador = Iniciador::all();
        $prioridad = PrioridadExpediente::all();
        $fecha = Carbon::now()->format('d-m-Y');
        //Area destino a la que se va a hacer el pase
        $areas = Area::all_areas();
        $create_exp = [$fecha, $iniciador, $motivoAll, $motivo, $prioridad,$areas];
        //$create_exp = [$fecha, $iniciador, $motivoAll, $motivo, $prioridad];
        return response()->json($create_exp,200);
    }

    public function createNroExpediente(Request $request)
    {
        $fecha_exp = Carbon::now()->format('d-m');
        $año_exp = Carbon::now()->format('Y');
        $nro_expediente = Expediente::nroExpediente($fecha_exp, $año_exp);
        return $nro_expediente;
    }

    public function store(StoreExpedienteRequest $request)
    {
        $expediente = new Expediente;
        $expediente->nro_expediente = $request->nro_expediente;
        $expediente->fojas = $request->nro_fojas;
        $expediente->fecha = Carbon::now()->format('Y-m-d');
        $expediente->prioridad_id = $request->prioridad;
        $expediente->tipo_expediente = $request->tipo_exp_id;
        $expediente->estado_expediente_id = '1';
        $expediente->area_actual_id = '13';
        $expediente->monto = $request->monto;
        //return response()->json($request,200);
        if ($request->validated())
        {
            $expediente->save();
            $extracto = new Extracto;
            $extracto->descripcion = $request->descripcion_extracto;
            $extracto->save();

            $caratula = new Caratula;
            $caratula->expediente_id = $expediente->id;
            $caratula->iniciador_id = $request->iniciador_id;
            $caratula->extracto_id = $extracto->id;
            if($caratula->save())
            {
                $user = User::findOrFail($request->user_id);
                $historial = new Historial;
                $historial->expediente_id = $expediente->id;
                $historial->user_id = $user->id;
                $historial->area_origen_id = 6;
                $historial->area_destino_id = 6;
                $historial->fojas = $request->nro_fojas;
                $historial->fecha = Carbon::now()->format('Y-m-d');
                $historial->hora = Carbon::now()->format('h:i');
                $historial->motivo = "created";
                $historial->estado = 1;
                //$historial->archivos = $request->archivos;
                $historial->save();
                /* 
                * Cuando Realiza el pase
                */
                $historial = new Historial;
                $historial->expediente_id = $expediente->id;
                $historial->user_id = $request->user_id;
                $historial->area_origen_id = $user->area_id;
                $historial->area_destino_id = $request->area_id;
                $historial->fojas = $request->nro_fojas;
                $historial->fecha = Carbon::now()->format('Y-m-d');
                $historial->hora = Carbon::now()->format('h:i');
                $historial->motivo = "pase";
                $historial->estado = "1";//Enviado
                $historial->save();

                $estado_actual = Area::findOrFail($request->area_id);
                
                //ARCHIVOS/////////////////////////////////////////////
                $zip = new ZipArchive;
                $fileName = $request->nro_expediente.'.zip';
                $storage_path = storage_path();
                $path =$storage_path. "\\" .$fileName;//;."/app/public/archivos_formularios/".$fileName;
                //"/app/public/archivos_formularios/"
                $array_archivos = [$request->archivo1, $request->archivo2];
                if(!is_null($array_archivos[0]))
                {
                    if($zip->open($path,ZipArchive::CREATE) === true)
                    {
                        foreach ($array_archivos as $key => $value)
                        {
                            $relativeNameInZipFile = $value->getClientOriginalName();
                            $zip->addFile($value, $relativeNameInZipFile);
                        }
                        $zip->close();
                    }
                    $expediente->archivos = $fileName;
                    $expediente->save();
                }
                ////////////////////////////////////////////////////////
                $datos = [$expediente->fecha,$caratula->iniciador->nombre,$extracto->descripcion,$estado_actual,$path];
                return response()->json($datos,200);
            } 
            
        }
        
        return response()->json('Error',200);

        /*Ejemplo para el postman
         {   
            "nro_expediente" : "02221-2510-123122023/2021",
            "nro_fojas" : "250",
            "prioridad" : "1",
            "fecha" : "2021-10-25 21:21:57",
            "tipo_exp_id" : "1",
            "area_actual_id" : "6",
            "monto" : "100",
            "user_id" : "1",
            "area_id" : "1",
            "iniciador_id": "1",
            "descripcion_extracto": "Extracto"
         }
        */
    }

    public function show(Request $request)
    {
        $expediente = Expediente::findOrFail($request->expediente_id);
        $iniciador = $expediente->caratula->iniciador;
        $extracto = $expediente->caratula->extracto;
        $fecha_sistema = $expediente->created_at->format('Y-m-d');
        $fecha_exp = $expediente->fecha;
        $nro_cuerpos = $expediente->caratula->cuerpos()->count();
        $fojas = $expediente->fojas;
        $detalle = [$expediente->nro_expediente,
                    $iniciador->nombre,
                    $extracto->descripcion,
                    $fecha_sistema,
                    $fecha_exp,
                    $nro_cuerpos,
                    $fojas];
        return response()->json($detalle,200);
    }

    public function indexPorAreas(Request $request)
    {
        $expedientes = Expediente::where('area_actual_id',$request->area_actual_id)->where('area_actual_type',$request->area_actual_type)->get();
        $cuerpos = Cuerpo::where('area_id', $request->area_actual_id)->where('area_type', $request->area_actual_type)->get();
        $datos = [$expedientes, $cuerpos];
        return response()->json($datos, 200);
    }

    public function update()//$request)
    {
        $request = new Request;
        $request->id_cuerpo = 50;
        $request->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
        ///////////////////////////////////////////////////
        $cuerpo = Cuerpo::find($request->id_cuerpo);
        $cuerpo->cantidad_fojas = $request->cantidad_fojas;
        //dd($cuerpo);
        $caratula = $cuerpo->caratula()->first();
        //dd($caratula);
        //$expediente = $caratula->expediente()->get();
        $expediente = Expediente::find($caratula->expediente_id)->first();
        dd($expediente);

    }

    public function bandeja(Request $request)//entrada,area,mis expedientes,enviado,recuperados
    {
        $estado = $request->estado;//parametro
        $bandeja = $request->bandeja;
        $user_id = $request->user_id;
        $listado_expedientes = Expediente::listadoExpedientes($user_id,$estado,$bandeja);
        return response()->json($listado_expedientes,200);
    }

    public function contadorBandejaEntrada(Request $request)
    {
        //$cuerpos = Cuerpo::All();
        $user_area = $request->area_id;
        /*$contador = $cuerpos->where('estado', 1)
                            ->where('area_id', $user_area)->count();

        $contador = $cuerpos->where('estado', 1)
                    ->where('area_id', $user_area)->count();

        foreach ($cuerpos as $cuerpo){
            $cuerpo->historiales()-
        }*/
       $contador = Expediente::listadoExpedientes($request->user_id,1,1)->count();
        return response()->json($contador, 200);
    }

    /*
    * Busca los expedientes por: 1-iniciador, 2-nro_cheque, 3-nro_expediente
    */
    public function buscarExpediente(Request $request)
    {
        $buscar_por = $request->buscar_por;//1-iniciador, 2-nro_cheque, 3-nro_expediente
        $valor = $request->valor;
        $listado_expedientes = Expediente::buscarPor($valor,$buscar_por);
       // return response()->json($listado_expedientes,200);
        return $buscar_por;
    }

    /*
    * Retorna todos los Expedientes
    */
    public function AllExpedientes()
    {
        $expedientes = Expediente::all();
        $listado_expedientes = Collect([]);
        foreach ($expedientes as $expediente) {
            $listado_expedientes->push($expediente->datosExpediente());
        }
        return response()->json($listado_expedientes,200);
    }

}
