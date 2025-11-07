<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materia;

use Illuminate\Database\QueryException;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();

        return view('division.materias', compact('materias'));
    }
public function crearMateria(Request $request)
{
    // Validación previa para evitar errores de clave duplicada
    $request->validate([
        'txtClave' => 'required|unique:materias,clave_materia',
        'txtNombre' => 'required',
        'txtCreditos' => 'required|integer',
    ]);

    try {
        $materia = Materia::create([
            'clave_materia' => $request->txtClave,
            'nombre' => $request->txtNombre,
            'creditos' => $request->txtCreditos
        ]);

        return back()->with("Correcto", "Se agregó la materia correctamente");

    } catch (QueryException $e) {
        // Captura de clave duplicada en PostgreSQL
        if ($e->getCode() === '23505') {
            return back()->with("Incorrecto", "Esa clave de materia ya existe");
        }

        return back()->with("Incorrecto", "Error al agregar la materia: " . $e->getMessage());
    }
}
   
public function actuaMateria(Request $request, $id)
    {
        try {
            // Buscar la materia por su id
            $materia = Materia::findOrFail($id);

            // Actualizar los campos
            $materia->update([
                'clave_materia' => $request->txtClave,
                'nombre'        => $request->txtNombre,
                'creditos'      => $request->txtCreditos
            ]);

            return back()->with("Correcto", "Se actualizó la materia correctamente");        

        } catch (\Illuminate\Database\QueryException $e) {

            // Manejar error de clave duplicada
            if ($e->errorInfo[1] == 1062){
                return back()->with("Incorrecto","Esa clave de materia ya existe");
            }

            return back()->with("Incorrecto","Error al actualizar la materia: ".$e->getMessage());
        
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si no encuentra la materia
            return back()->with("Incorrecto", "Materia no encontrada");
        }
    }

 public function eliminarMateria($id)
{
    try {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return back()->with('Correcto', 'Materia eliminada correctamente');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return back()->with('Incorrecto', 'Materia no encontrada');
    } catch (\Exception $e) {
        return back()->with('Incorrecto', 'Error al eliminar la materia: ' . $e->getMessage());
    }
}


}
