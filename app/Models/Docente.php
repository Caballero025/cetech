<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'rfc',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'curp',
        'email',
        'user_id'
    ];
}
