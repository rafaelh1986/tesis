<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = "proveedor";
    protected $fillable = ['razon_social','nit','telefono','email','estado','created_at','updated_at'];
}
