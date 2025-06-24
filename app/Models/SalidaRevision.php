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
 
    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor','id_proveedor','id');
    }
    public function inventario(){
        return $this->belongsTo('App\Models\Inventario','id_inventario','id');
    }
    
};
