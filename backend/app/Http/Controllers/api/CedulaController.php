<?php

namespace App\Http\Controllers\api;

use App\Models\Cedula;
use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCedulaRequest;

class CedulaController extends Controller
{
    public function index()
    {
        $cedula = Cedula::index();
        return response()->json($cedula,200);
    }

    public function create(Request $request)
    {
        $expedientes = Expediente::listadoExpedientes($request->user_id,3,3);//Mi Expedientes
        $create_cedula = [$expedientes];
        return response()->json($create_cedula,200);
    }

    public function store(StoreCedulaRequest $request)
    {
        /*if(validated())
        {*/
            $cedula = new Cedula;
            $cedula->expediente_id  = $request->expediente_id;
            $cedula->user_id        = $request->user_id;
            $cedula->descripcion    = $request->descripcion;
            $cedula->save();
            return response()->json($cedula->getDatos(),200);
        //}
    }

    public function edit(Request $request)
    {
        $cedula = Cedula::findOrFail($request->id);
        $expediente = Expediente::listadoExpedientes($request->user_id,3,3);//Mi Expedientes
        $edit_cedula = [$expediente, $cedula->getDatos()];
        return response()->json($edit_cedula, 200);
    }

    public function update(Request $request)
    {
        $cedula = Cedula::findOrFail($request->id);
        $cedula->expediente_id = $request->expediente_id;
        $cedula->descripcion = $request->descripcion;
        $cedula->update();
        return response()->json($cedula->getDatos(), 200);
    }

    /*
        Metodo para (leer nombre)
        Autor: yop kien +
    */
    public function contar_cedulas(Request $request)
    {
        $cedula     = Cedula::find($request->id);
        $expediente = Expediente::find($request->expediente_id);
        return response()->json($cedula->getDatos(), 200);
    }
}
