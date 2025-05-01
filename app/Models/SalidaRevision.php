<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class SalidaRevision extends Model
{
    use HasFactory;
    protected $table = "salida_revision";
    protected $fillable = ['id_proveedor','id_inventario','descripcion','fecha_salida','descripcion',
        'fecha_retorno','observaciones','estado','created_at','updated_at'];

    public function tipo_equipo(){
        return $this->hasOne('App\Models\TipoEquipo','id','id_tipo_equipo');
    }
    
    public function proveedor(){
        return $this->hasOne('App\Models\Proveedor','id','id_proveedor');
    }
    public function inventario(){
        return $this->hasOne('App\Models\Inventario','id','id_inventario');
    }
    
};
