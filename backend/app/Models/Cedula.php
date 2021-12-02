<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cedula extends Model
{
    use HasFactory;

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public static function index()
    {
        $cedulas = Cedula::all();
        $array_cedulas = collect([]);
        foreach ($cedulas as $cedula)
        {
            $array_cedulas->push([
                                'cedula_id' => $cedula->id,
                                'nro_expediente' => $cedula->expediente->nro_expediente,
                                'extracto' => $cedula->expediente->caratula->extracto->descripcion,
                                'descripcion' => $cedula->descripcion
                            ]);
        }
        return $array_cedulas;
    }

    public function getDatos()
    {
        $array_cedula = collect([]);
        $array_cedula->push([
                            'cedula_id' => $this->id,
                            'nro_expediente' => $this->expediente->nro_expediente,
                            'extracto' => $this->expediente->caratula->extracto->descripcion,
                            'descripcion' => $this->descripcion
                           ]);
        return $array_cedula;
    }

}