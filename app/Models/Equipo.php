<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Equipo extends Model
{
    use HasFactory;
    protected $table = "equipo";
    protected $fillable = ['id_modelo','id_marca','id_proveedor','garantia','cantidad',
    'fecha_recepcion','orden_compra','estado','created_at','updated_at'];

    public function modelo() {
        return $this->belongsTo(Modelo::class, 'id_modelo');
    }
    public function marca() {
        return $this->belongsTo(Marca::class, 'id_marca');
    }
    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
    
};
