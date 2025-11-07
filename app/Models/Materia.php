<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    protected $fillable = [
        'clave_materia',
        'nombre',
        'creditos',
    ];

    public function planesEstudio() {
        return $this->belongsToMany(PlanEstudio::class);
    }
}
