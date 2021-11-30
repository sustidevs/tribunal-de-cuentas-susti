<?php

namespace App\Http\Controllers\api;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::index();
        return response()->json($notificaciones, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //$notificacion = 
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $notificacion = Notificacion::findOrFail($request->id);
        $notificacion->fecha = Carbon::now();
        $notificacion->estado = $request->estado;
        return response()->json($notificacion, 200);
    }

    public function destroy($id)
    {
        //
    }
}
