<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\User;


use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();

        return view('Escolares.docentes', compact('docentes'));
    }

    public function crearDocente(Request $request)
    {

        try {

            $fechaNacimiento =  substr($request->txtCURP, 4, 6);

            $user = User::create([
                'name' => $request->txtNombre.' '.$request->txtApPaterno.' '.$request->txtApMaterno,
                'email' => $request->txtEmail,
                'password' => Hash::make('Tecsj+'.$fechaNacimiento),
            ]);

            $user->assignRole('docente');

            $alumno = Docente::create([
                'rfc' => $request->txtRFC,
                'nombre' => $request->txtNombre,
                'ap_paterno' => $request->txtApPaterno,
                'ap_materno' => $request->txtApMaterno,
                'curp' => $request-> txtCURP,
                'email' => $request->txtEmail,
                'user_id' => $user->id,
            ]);

            return back()->with("Correcto", "Se agrego el docente correctamente");
        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Ese RFC ya existe");
            };

            return back()->with("Incorrecto", "Error al agregar el docente " . $e);
        }
    }

    public function editarDocente(Request $request, $user_id){
    try {
        // Buscar docente por user_id
        $docente = Docente::where('user_id', $user_id)->firstOrFail();

        // Validar datos (opcional)
        $request->validate([
            'txtRFC' => 'required|string|max:13',
            'txtNombre' => 'required|string|max:255',
            'txtApPaterno' => 'required|string|max:255',
            'txtApMaterno' => 'nullable|string|max:255',
            'txtCURP' => 'required|string|max:18',
            'txtEmail' => 'required|email|max:255|unique:users,email,' . $user_id,
        ]);

        // Actualizar datos
        $docente->update([
            'rfc' => $request->txtRFC,
            'nombre' => $request->txtNombre,
            'ap_paterno' => $request->txtApPaterno,
            'ap_materno' => $request->txtApMaterno,
            'curp' => $request->txtCURP,
            'email' => $request->txtEmail,
        ]);

        return back()->with('Correcto', 'Docente actualizado correctamente');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return back()->with('Incorrecto', 'Docente no encontrado');
    } catch (\Exception $e) {
        return back()->with('Incorrecto', 'Error al actualizar docente: ' . $e->getMessage());
    }
}

public function eliminarDocente($user_id){
    try {
        // Buscar el alumno usando user_id
        $docente = Docente::where('user_id', $user_id)->firstOrFail();

        // Eliminar el alumno
        $docente->delete();

        // Eliminar el usuario asociado
        $usuario = User::find($user_id);
        if($usuario){
            $usuario->delete();
        }

        return back()->with('Correcto', 'Docente y usuario eliminados correctamente');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return back()->with('Incorrecto', 'Docente no encontrado');
    } catch (\Exception $e) {
        return back()->with('Incorrecto', 'Error al eliminar: ' . $e->getMessage());
    }
}


}
