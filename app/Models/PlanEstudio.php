<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    protected $table = 'planes_estudio';

    public $timestamps = false;

    protected $fillable = [
        'clave_plan_estudio',
        'carrera'
    ];

    public function materias() {
        return $this->belongsToMany(Materia::class);
    }

}
