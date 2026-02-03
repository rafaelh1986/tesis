<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoDevolucion extends Model
{
    use HasFactory;

    protected $table = "motivo_devolucion";
    protected $fillable = ['nombre', 'descripcion', 'estado', 'created_at', 'updated_at'];

    public function devoluciones()
    {
        return $this->hasMany(Devolucion::class, 'id_motivo_devolucion');
    }
}