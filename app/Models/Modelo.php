<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $table = "modelo";
    protected $fillable = ['id_tipo_equipo','nombre_comercial','nombre_tecnico','estado','created_at','updated_at'];

    public function tipo_equipo(){
        return $this->hasOne('App\Models\TipoEquipo','id','id_tipo_equipo');
    }
}
