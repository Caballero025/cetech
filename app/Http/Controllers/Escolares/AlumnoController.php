<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\PlanEstudio;
use App\Models\EstatusAlumno;
use App\Models\TipoAlumno;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\QueryException;

class AlumnoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $alumnos = Alumno::all(); //Select * from planes_estudio;
        $planesEstudio = PlanEstudio::all();
        $tiposAlumnos = TipoAlumno::all();
        $estatusAlumnos = EstatusAlumno::all();

        #$especialidades = Especialidad::all(); //Select * from planes_estudio;
        #return $planesEstudio;
        return view('Escolares.alumnos', compact('alumnos', 'planesEstudio', 'tiposAlumnos', 'estatusAlumnos'));
    }

    public function crearAlumno(Request $request)
    {

        try {

            $fechaNacimiento =  substr($request->txtCURP, 4, 6);

            $user = User::create([
                'name' => $request->txtNombre . ' ' . $request->txtApPaterno . ' ' . $request->txtApMaterno,
                'email' => 'l' . $request->txtNoControl . '@sjuanrio.tecnm.mx' ,
                'password' => Hash::make('Tecsj+'.$fechaNacimiento),
            ]);

            $user->assignRole('alumno');

            $alumno = Alumno::create([
                'numero_de_control' => $request->txtNoControl,
                'nombre' => $request->txtNombre,
                'ap_paterno' => $request->txtApPaterno,
                'ap_materno' => $request->txtApMaterno,
                'curp' => $request-> txtCURP,
                'semestre' => $request->txtSemestre,
                'plan_estudio_id' => $request->txtPlan,
                'estatus_alumno_id' => $request->txtEstatus,
                'tipo_alumno_id' => $request->txtTipoAlumno,
                'user_id' => $user->id,
            ]);

            return back()->with("Correcto", "Se agrego el alumno correctamente");
        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Ese número de control ya existe");
            };

            return back()->with("Incorrecto", "Error al agregar el alumno " . $e);
        }
    }
}
