<?php

namespace App\Http\Controllers\Escolares;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\Materia;

class MateriaPlanEstudioController extends Controller
{
    public function getMaterias($id){
        $planEstudio = PlanEstudio::find($id);
        #$materias = Materia::all();
        #return $planEstudio->materias;
        $materias = Materia::whereRaw("id not in (select materia_id from materia_plan_estudio 
        where plan_estudio_id = ? )", [ $planEstudio->id ])->get();
        return view('division.materias-plan-estudio',compact('planEstudio', 'materias'));
    }

    public function addMateria(Request $request, $id){
        $planEstudio = PlanEstudio::find($id);
        $planEstudio->materias()->attach($request->txtIdMateria);

        return back()->with("Correcto", "Materia agregada correctamente");

    }
    public function deleteMateria($idPlan, $idMateria){
        $planEstudio = PlanEstudio::find($idPlan);
        $planEstudio->materias()->detach($idMateria);

        return back()->with("Correcto", "Se ha eliminado la materia correctamente");

    }

}
