<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $table = "modelo";
    protected $fillable = ['nombre_comercial','nombre_tecnico','estado','created_at','updated_at'];
}
