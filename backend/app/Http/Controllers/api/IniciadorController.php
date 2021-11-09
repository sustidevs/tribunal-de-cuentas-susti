<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iniciador;
use App\Models\TipoEntidad;
use Illuminate\Http\Request;

class IniciadorController extends Controller
{
    public function index()
    {
        $iniciadores = Iniciador::all();
        return response()->json($iniciadores, 200);
    }

    public function create()
    {
        $tipo_entidad = TipoEntidad::all();
        return $tipo_entidad;
    }

    public function store(Request $request)
    {
        //if($request->validated()) //TODO para cuando haya validaciones
        //{
            $iniciador = new Iniciador;
            $iniciador->id_tipo_entidad = $request->tipo_entidad;
            $iniciador->nombre = $request->nombre;
            $iniciador->apellido = $request->apellido;
            $iniciador->dni = $request->dni;
            $iniciador->cuil = $request->cuil;
            $iniciador->cuit = $request->cuit;
            $iniciador->telefono = $request->telefono;
            $iniciador->email = $request->email;
            $iniciador->direccion = $request->direccion;
            $iniciador->area_reparticiones = $request->area_reparticiones;
            $iniciador->save();
            return response()->json($iniciador, 200);
        //}
    }

    //DATOS DE PRUEBA
    /*{     
        "tipo_entidad": 5,
        "nombre": "Valentino",
        "apellido": "Rossi",
        "dni": 27885823,
        "cuil": 20278858233,
        "cuit": 46,
        "telefono": 4646464646,
        "email": "vr46@mtgp.com",
        "direccion": "Tavullia 1337"
    }*/

    public function show(Request $request)
    {
        $iniciador = Iniciador::findOrFail($request->id);
        return response()->json($iniciador, 200);
    }

    public function update(Request $request)
    {
        //if($request->validated()) //TODO para cuando haya validaciones
        //{    
            $updateIniciador = Iniciador::findOrFail($request->id);
            $updateIniciador->nombre = $request->nombre;
            $updateIniciador->apellido = $request->apellido;
            $updateIniciador->dni = $request->dni;
            $updateIniciador->cuil = $request->cuil;
            $updateIniciador->cuit = $request->cuit;
            $updateIniciador->telefono = $request->telefono;
            $updateIniciador->email = $request->email;
            $updateIniciador->direccion = $request->direccion;
            $updateIniciador->save();
            return response()->json($updateIniciador, 200);
        //}
    }
}
