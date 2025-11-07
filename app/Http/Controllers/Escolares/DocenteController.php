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
}
