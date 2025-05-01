<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Equipo extends Model
{
    use HasFactory;
    protected $table = "equipo";
    protected $fillable = ['id_tipo_equipo','id_modelo','id_marca','id_proveedor','garantia','cantidad',
    'fecha_recepcion','orden_compra','estado','created_at','updated_at'];

    public function tipo_equipo(){
        return $this->hasOne('App\Models\TipoEquipo','id','id_tipo_equipo');
    }
    public function modelo(){
        return $this->hasOne('App\Models\Modelo','id','id_modelo');
    }
    public function marca(){
        return $this->hasOne('App\Models\Marca','id','id_marca');
    }
    public function proveedor(){
        return $this->hasOne('App\Models\Proveedor','id','id_proveedor');
    }
    
};
