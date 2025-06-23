<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Empleado extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = "empleado";
    protected $fillable = ['id_persona','id_area','id_ciudad','id_cargo','email','telefono_interno',
    'fecha_ingreso','fecha_salida','estado','created_at','updated_at'];

    public function persona(){
        return $this->belongsTo('App\Models\Persona', 'id_persona');
    }
    public function area(){
        return $this->belongsTo('App\Models\Area', 'id_area');
    }
    public function ciudad(){
        return $this->belongsTo('App\Models\Ciudad', 'id_ciudad');
    }
    public function cargo(){
        return $this->belongsTo('App\Models\Cargo', 'id_cargo');
    }
    
};
