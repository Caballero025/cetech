<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlumno extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo',
    ];
}
