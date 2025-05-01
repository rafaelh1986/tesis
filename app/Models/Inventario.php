<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Inventario extends Model
{
    use HasFactory, HasRoles;
    
    protected $table = "inventario";
    protected $fillable = ['id_equipo','numero_serie','codigo_activo_fijo','estado','created_at','updated_at'];

    public function equipo(){
        return $this->hasOne('App\Models\Equipo','id','id_equipo');
    }
    
};
