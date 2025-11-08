<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodoController extends Controller
{
    public function index(){
        $periodos = Periodo::all();

        return view('Escolares.periodos', compact('periodos'));
    }

    public function createPeriodo(Request $request){
        $nombrePeriodo="";

        if ($request->txtPeriodo == '1'){
            $nombrePeriodo = 'Enero - Junio';
        }

        if ($request->txtPeriodo == '2'){
            $nombrePeriodo = 'Agosto - Diciembre';
        }

        if ($request->txtPeriodo == 'V'){
            $nombrePeriodo = 'Verano';
        }

        $periodo = Periodo::create([
            'clave_periodo' => $request->txtAnio.'-'.$request->txtPeriodo,
            'nombre_periodo' => $nombrePeriodo,
            'estatus'=> $request->txtEstatus
        ]);

        return back()->with("Correcto","Periodo agregado Correctamente");
    }


    public function editarPeriodo(Request $request, $id)
{
    // Buscar el periodo por ID
    $periodo = Periodo::findOrFail($id);

    // Determinar el nombre del periodo
    $nombrePeriodo = "";

    if ($request->txtPeriodo == '1') {
        $nombrePeriodo = 'Enero - Junio';
    }

    if ($request->txtPeriodo == '2') {
        $nombrePeriodo = 'Agosto - Diciembre';
    }

    if ($request->txtPeriodo == 'V') {
        $nombrePeriodo = 'Verano';
    }

    // Actualizar los datos
    $periodo->update([
        'clave_periodo' => $request->txtAnio . '-' . $request->txtPeriodo,
        'nombre_periodo' => $nombrePeriodo,
        'estatus' => $request->txtEstatus
    ]);

    return back()->with("Correcto", "Periodo actualizado correctamente");
}
    
public function deletePeriodo($id){
    try {
        // Buscar el alumno usando user_id
        $periodo = Periodo::findOrFail($id);

        // Eliminar el alumno
        $periodo->delete();


        return back()->with('Correcto', 'Periodo eliminado correctamente');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return back()->with('Incorrecto', 'Periodo no encontrado');
    } catch (\Exception $e) {
        return back()->with('Incorrecto', 'Error al eliminar: ' . $e->getMessage());
    }
}
}
