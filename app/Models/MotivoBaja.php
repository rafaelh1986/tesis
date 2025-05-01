<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoBaja extends Model
{
    use HasFactory;
    protected $table = "motivo_baja";
    protected $fillable = ['nombre','estado','created_at','updated_at'];
}
