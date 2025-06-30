<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class DetalleAsignacion extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = "detalle_asignacion";
    protected $fillable = ['id_asignacion','id_inventario','estado','created_at','updated_at'];

    public function asignacion(){
        return $this->belongsTo('App\Models\Asignacion','id_asignacion');
    }
    public function inventario(){
        return $this->belongsTo('App\Models\Inventario','id_inventario');
    }
   
};
