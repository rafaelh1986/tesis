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
        return $this->hasOne('App\Models\Persona','id','id_persona');
    }
    public function area(){
        return $this->hasOne('App\Models\Area','id','id_area');
    }
    public function ciudad(){
        return $this->hasOne('App\Models\Ciudad','id','id_ciudad');
    }
    public function cargo(){
        return $this->hasOne('App\Models\Cargo','id','id_cargo');
    }
    
};
