<?php

namespace App\Http\Controllers\api;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Area;
use App\Models\User;
use App\Models\Cuerpo;
use App\Models\SubArea;
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
        //Es necesario agregar para saber el area_destino al que se va a realizar el pase.
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
        $expediente->prioridad = $request->prioridad;
        $expediente->tipo_expediente = $request->tipo_exp_id;
        $expediente->estado_expediente = '2';
        $expediente->area_actual_id = '6';
        $expediente->area_actual_type = 'App\Models\SubArea';
        $expediente->monto = '3';//$request->monto;     TODO confirmar si monto va en nuevo expediente o en pase.
        //return response()->json($request,200);
        //ARCHIVOS/////////////////////////////////////////////////
        /*$zip = new ZipArchive;
        $fileName =  'Documentacion '.$expediente->nro_expediente.'.zip';
        $path = storage_path()."/app/public/archivos_formularios/" . $fileName;
        if(!is_null($request->archivos[0]))
        {
            if($zip->open($path,ZipArchive::CREATE) === true)
            {
                foreach ($request->archivos as $key => $value)
                {
                    $relativeNameInZipFile = $value->getClientOriginalName();
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            $expediente->archivos = $fileName;
        }*/
        //////////////////////////////////////////////////////////
        if ($request->validated())
        {
            $expediente->save();
            $extracto = new Extracto;
            $extracto->descripcion = $request->descripcion_extracto;
            $extracto->save();

            if($request->iniciador_id != null)//TODO validar que no venga null y saca este if
            {
                $caratula = new Caratula;
                $caratula->expediente_id = $expediente->id;
                $caratula->iniciador_id = $request->iniciador_id;
                $caratula->extracto_id = $extracto->id;
                if($caratula->save())
                {
                    do
                    {
                        $cuerpo = new Cuerpo;
                        if($expediente->fojas > Cuerpo::CANTIDAD_FOJAS)
                        {
                            $cuerpo->cantidad_fojas = Cuerpo::CANTIDAD_FOJAS;
                            $cuerpo->caratula_id = $caratula->id;
                            $cuerpo->estado = 1;
                            $cuerpo->area_id = $expediente->area_actual_id;
                            $cuerpo->area_type = $expediente->area_actual_type;
                            $cuerpo->save();
                            
                                $user = User::findOrFail($request->user_id);
                                $cuerpo_id = $cuerpo->id;
                                $historial = new Historial;
                                $historial->cuerpo_id = $cuerpo_id;
                                $historial->user_id = $user->id;
                                $historial->area_origen_id = 6;
                                $historial->area_destino_id = 6;
                                $historial->area_origen_type = 'App\Models\SubArea';
                                $historial->area_destino_type = 'App\Models\SubArea';
                                $historial->fojas = $cuerpo->cantidad_fojas;
                                $historial->fecha = Carbon::now()->format('Y-m-d');
                                $historial->hora = Carbon::now()->format('h:i');
                                $historial->motivo = "created";
                                $historial->estado = 1;
                                //$historial->archivos = $request->archivos;
                                $historial->save();
                            
                            $expediente->fojas = $expediente->fojas - Cuerpo::CANTIDAD_FOJAS;

                            if ($expediente->fojas <= Cuerpo::CANTIDAD_FOJAS)
                            {
                                $cuerpo = new Cuerpo;
                                $cuerpo->cantidad_fojas = $expediente->fojas;
                                $cuerpo->caratula_id = $caratula->id;
                                $cuerpo->estado = 1;
                                $cuerpo->area_id = $expediente->area_actual_id;
                                $cuerpo->area_type = $expediente->area_actual_type;
                                $cuerpo->save();
                                
                                    $user = User::findOrFail($request->user_id);
                                    $cuerpo_id = $cuerpo->id;
                                    $historial = new Historial;
                                    $historial->cuerpo_id = $cuerpo_id;
                                    $historial->user_id = $user->id;
                                    $historial->area_origen_id = 6;
                                    $historial->area_destino_id = 6;
                                    $historial->area_origen_type = 'App\Models\SubArea';
                                    $historial->area_destino_type = 'App\Models\SubArea';
                                    $historial->fojas = $cuerpo->cantidad_fojas;
                                    $historial->fecha = Carbon::now()->format('Y-m-d');
                                    $historial->hora = Carbon::now()->format('h:i');
                                    $historial->motivo = "created";
                                    $historial->estado = 1;
                                    //$historial->archivos = $request->archivos;
                                    $historial->save();
                                
                            }
                        }
                        else if ($expediente->fojas <= Cuerpo::CANTIDAD_FOJAS)
                        {
                            $cuerpo->cantidad_fojas = $expediente->fojas;
                            $cuerpo->caratula_id = $caratula->id;
                            $cuerpo->estado = 1;
                            $cuerpo->area_id = $expediente->area_actual_id;
                            $cuerpo->area_type = $expediente->area_actual_type;
                            $cuerpo->save();

                            $user = User::findOrFail($request->user_id);
                            $cuerpo_id = $cuerpo->id;
                            $historial = new Historial;
                            $historial->cuerpo_id = $cuerpo_id;
                            $historial->user_id = $user->id;
                            $historial->area_origen_id = 6;
                            $historial->area_destino_id = 6;
                            $historial->area_origen_type = 'App\Models\SubArea';
                            $historial->area_destino_type = 'App\Models\SubArea';
                            $historial->fojas = $cuerpo->cantidad_fojas;
                            $historial->fecha = Carbon::now()->format('Y-m-d');
                            $historial->hora = Carbon::now()->format('h:i');
                            $historial->motivo = "created";
                            $historial->estado = 1;
                            //$historial->archivos = $request->archivos;
                            $historial->save();
                            
                        }
                    }
                    while ( ($expediente->fojas > Cuerpo::CANTIDAD_FOJAS) );
                }
                /* Realiza el pase de los cuerpos
                * Recorro todos los cuerpos del exp. creados y los muevo al area destino incidado  
                */ 
                foreach ($expediente->caratula->cuerpos as $cuerpo) {
                    $cuerpo->estado = "1";//Enviado (estado actual del cuerpo)
                    $cuerpo->update();//TODO ver si es necesario actualizar el cuerpo, (si el exp es nuevo el estado ya deberia estar actualizado)
                    $historial = new Historial;
                    $historial->cuerpo_id = $cuerpo->id;
                    $historial->user_id = $request->user_id;
                    $historial->area_origen_id = $user->area_id;
                    $historial->area_origen_type = $user->area_type;
                    
                    if ($request->tipo_area == "Area") 
                    {
                        $area = Area::findOrFail($request->area_id);
                        $area_type = Area::class;
                    } else 
                    {
                        $area = SubArea::findOrFail($request->area_id);
                        $area_type = SubArea::class;
                    }
                    $historial->area_destino_id = $area->id;//TODO revisar como viene del front el dato (Areas::all_datos)
                    $historial->area_destino_type = $area_type;

                    $historial->fojas = $cuerpo->cantidad_fojas;
                    $historial->fecha = Carbon::now()->format('Y-m-d');
                    $historial->hora = Carbon::now()->format('h:i');
                    $historial->motivo = "";
                    $historial->estado = "1";//Enviado
                    $historial->save();
                }
                $estado_actual = $area;
                $datos = [$expediente->fecha,$caratula->iniciador->nombre,$extracto->descripcion,$estado_actual];
                return response()->json($datos,200);
            }
           
        }
        return response()->json('Error',200);
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
        $cuerpos = Cuerpo::All();
        $user_area = $request->area_id;
        $contador = $cuerpos->where('estado', 1)
                            ->where('area_id', $user_area)->count();
        return response()->json($contador, 200);
    }

    /*
    * Busca los expedientes por: 1-iniciador, 2-nro_cheque, 3-nro_expediente
    */
    public function buscarExpediente(Request $request)
    {
        //$buscar_por = $request->buscar_por;//1-iniciador, 2-nro_cheque, 3-nro_expediente
        $valor = $request->valor;
        $listado_expedientes = Expediente::buscarPor($valor);
        return response()->json($listado_expedientes,200);
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
