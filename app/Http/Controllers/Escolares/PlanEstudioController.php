<?php

namespace App\Http\Controllers\Escolares;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\Especialidad;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\TryCatch;

class PlanEstudioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $planesEstudio = PlanEstudio::all(); //Select * from planes_estudio;
        $especialidades = Especialidad::all(); //Select * from planes_estudio;
        #return $planesEstudio;
        return view('Escolares.planes-estudio', compact('planesEstudio','especialidades'));
    }
    
    public function crearPlanEstudio(Request $request){

            try {
                $planEstudio = PlanEstudio::create([
                    'clave_plan_estudio' => $request->txtClave,
                    'carrera' => $request->txtCarrera
                ]);
        
                return back()->with("Correcto","Se agrego el plan de estudio correctamente");        

            } catch (QueryException $e){

                if ($e->errorInfo[1] == 1062){
                    return back()->with("Incorrecto","Esa clave de plan de estudio ya existe");
                };
                
                return back()->with("Incorrecto","Error al agregar plan estudio ".$e);
            }
        
    } 

    public function eliminarPlanEstudio ($id) {
        try {
            // select * from planes_estudio where id=$id
            $planEstudio = PlanEstudio::findOrFail($id);

            // delete from planes_estudio where id=$id 
            $planEstudio->delete();
            return back()->with("Correcto","Se ha eliminado el plan de estudio correctamente");

        } catch (QueryException $e) {
            return back()->with("Incorrecto","Error al borrar el plan de estudio ".$e);
        }
    }

    public function actualizarPlanEstudio (Request $request, $id) {
        try {
            // select * from planes_estudio where id=$id
            $planEstudio = PlanEstudio::findOrFail($id);
            $planEstudio->clave_plan_estudio = $request->txtClave;
            $planEstudio->carrera = $request->txtCarrera;
            $planEstudio->save();
            
            return back()->with("Correcto","Se ha actualizado el plan de estudio correctamente");

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062){
                return back()->with("Incorrecto","Error al actualizar - Esa clave de plan de estudio ya existe");
            };
            
            return back()->with("Incorrecto","Error al actualizar plan estudio ".$e);
        }
    }

}
