<?php

namespace App\Http\Controllers;

use App\Models\PaseExpediente;
use Illuminate\Http\Request;
use App\Models\TipoExpediente;

class PaseExpedienteController extends Controller
{
    public function store()
    {
        /////////////////////////////////////////////////////////////////////////////////
        $request = new Request;
        $request->cuerpo_id = 1;
        $request->area_origen_id = 1; //se puede sacar del area del usuario logueado
        $request->sub_area_origen_id = 1; //se puede sacar del area del usuario logueado
        $request->area_destino_id = 2; // desplegable en el create
        $request->sub_area_destino_id = 2; //desplegable en el create
        $request->motivo = 'motivo del pase';
        $request->user_id = 1;
        //////////////////////////////////////////////////////////////////////////////////

        $pase_expediente = new PaseExpediente;
        $pase_expediente->cuerpo_id = $request->cuerpo_id;
        $pase_expediente->area_origen_id = $request->area_origen_id;
        $pase_expediente->sub_area_origen_id = $request->sub_area_origen_id;
        $pase_expediente->area_destino_id = $request->area_destino_id;
        $pase_expediente->sub_area_destino_id = $request->sub_area_destino_id;
        $pase_expediente->motivo = $request->motivo;
        $pase_expediente->user_id = $request->user_id;
        $pase_expediente->save();
        return $pase_expediente;

    }
}
