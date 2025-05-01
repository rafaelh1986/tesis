<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Asignacion extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = "asignacion";
    protected $fillable = ['id_empleado','fecha_asignacion','estado','created_at','updated_at'];

    public function empleado(){
        return $this->hasOne('App\Models\Empleado','id','id_empleado');
    }
    public function detalle_asignacion(){
        return $this->hasMany('App\Models\DetalleAsignacion','id_asignacion','id');
    }
};
