<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Concat;

class Iniciador extends Model
{
    use HasFactory;

    protected $table = "iniciadores";
    const NRO_INICIADOR = 800;

    public function tipoEntidad()
    {
        return $this->belongsTo(TipoEntidad::class);
    }

    public function extractos()
    {
        return $this->hasMany(Extracto::class);
    }

    public function caratulas()
    {
        return $this->hasMany(Caratula::class);
    }
}
