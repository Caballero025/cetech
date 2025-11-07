<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';

    public $timestamps = false;

    protected $fillable = [
        'clave_especialidad',
        'especialidad',
        'plan_estudio_id'
    ];
}
