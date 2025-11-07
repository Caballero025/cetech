<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;
use Illuminate\Database\QueryException;


class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function crearEspecialidad (Request $request){

        try {
            $especialidad = Especialidad::create([
                'clave_especialidad' => $request->txtClave,
                'especialidad' => $request->txtEspecialidad,
                'plan_estudio_id' => $request->txtPlan,
            ]);
    
            return back()->with("Correcto","Se agrego la especialidad correctamente");        

        } catch (QueryException $e){

            if ($e->errorInfo[1] == 1062){
                return back()->with("Incorrecto","Esa clave de especialidad ya existe");
            };
            
            return back()->with("Incorrecto","Error al agregar la especialidad ".$e);
        }
    }
}
