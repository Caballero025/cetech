<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstatusAlumno extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre_estatus',
    ];
}
