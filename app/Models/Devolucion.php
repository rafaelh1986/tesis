<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = "devolucion";
    protected $fillable = ['id_detalle_asignacion', 'id_motivo_devolucion', 'fecha_devolucion', 'usuario_devolucion', 'observaciones', 'estado', 'created_at', 'updated_at'];

    public function detalleAsignacion()
    {
        return $this->belongsTo(DetalleAsignacion::class, 'id_detalle_asignacion');
    }

    public function motivo()
    {
        return $this->belongsTo(MotivoDevolucion::class, 'id_motivo_devolucion');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_devolucion');
    }
}