<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class DetalleAsignacion extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = "detalle_asignacion";
    protected $fillable = ['id_asignacon','id_inventario','estado','created_at','updated_at'];

    public function asignacion(){
        return $this->hasOne('App\Models\Asignacion','id','id_asignacion');
    }
    public function inventario(){
        return $this->hasOne('App\Models\Inventario','id','id_inventario');
    }
   
};
