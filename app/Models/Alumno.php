<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'numero_de_control',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'curp',
        'semestre',
        'plan_estudio_id',
        'estatus_alumno_id',
        'tipo_alumno_id',
        'user_id'


    ];

    public function plan_estudio (){
        return $this->belongsTo(PlanEstudio::class); 
    }

    public function tipo_alumno (){
        return $this->belongsTo(TipoAlumno::class); 
    }

    public function estatus_alumno (){
        return $this->belongsTo(EstatusAlumno::class); 
    }
}

