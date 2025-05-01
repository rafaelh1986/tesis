<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class BajaInventario extends Model
{
    use HasFactory;
    protected $table = "baja_inventario";
    protected $fillable = ['id_inventario','id_motivo_baja','fecha','gestion','estado','created_at','updated_at'];

    public function inventario(){
        return $this->hasOne('App\Models\Inventario','id','id_inventario');
    }
    public function motivo_baja(){
        return $this->hasOne('App\Models\MotivoBaja','id','id_motivo_baja');
    }
        
};
