@extends('layouts.base')
@section('content')
<h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>
    <div class="box">
        @if (session('Correcto'))
            <div class="notification is-success is-light">
                <button class="delete"></button>
                {{ session('Correcto') }}
            </div>
        @endif
        @if (session('Incorrecto'))
            <div class="notification is-danger is-light">
                <button class="delete"></button>
                {{ session('Incorrecto') }}
            </div>
        @endif

        <div class="buttons">
            <a href="{{ route('home') }}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-success js-modal-trigger" data-target="modal-nvo-alumno">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Alumno
            </a>
        </div>
        <table class="table is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>No Control</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>CURP</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Estatus</th>
                    <th>Tipo de alumno</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $alumnos as $alumno )
                    <tr>
                        <td>{{$alumno->numero_de_control}}</td>
                        <td>{{$alumno->nombre}}</td>
                        <td>{{$alumno->ap_paterno}}</td>
                        <td>{{$alumno->ap_materno}}</td>
                        <td>{{$alumno->curp}}</td>
                        <td>{{$alumno->semestre}}</td>
                        <td>{{$alumno->plan_estudio_id}}</td>
                        <td>{{$alumno->estatus_alumno_id}}</td>
                        <td>{{$alumno->tipo_alumno_id}}</td>
                        <td>
                            <div class="field is-grouped">
                                <<form method="POST" action="{{ route('AlumnoEliminar', $alumno->user_id) }}">>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger"
                                        onclick=" return confirm('¿Estás seguro de eliminar este plan de estudio?') ">
                                        <i class='fa-solid fa-trash-can'></i>
                                    </button>
                                </form>
                                <button class="button is-warning js-modal-trigger"
                                    data-target="modal-{{ $alumno->user_id}}">
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </button>
                                <div id="modal-{{ $alumno->user_id }}" class="modal">
    <div class="modal-background"></div>

    <div class="modal-content">
        <div class="box">
            <p class="title is-5 has-text-centered">Actualizar Alumno</p>
            <form method="POST" action="{{ route('AlumnoActualizar', $alumno->user_id) }}">
                 @csrf
                 @method('PATCH')

                <div class="field">
                    <label class="label">Número de Control:</label>
                    <div class="control">
                        <input class="input" type="text" name="numero_de_control" value="{{ $alumno->numero_de_control }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Nombre:</label>
                    <div class="control">
                        <input class="input" type="text" name="nombre" value="{{ $alumno->nombre }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Apellido Paterno:</label>
                    <div class="control">
                        <input class="input" type="text" name="ap_paterno" value="{{ $alumno->ap_paterno }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Apellido Materno:</label>
                    <div class="control">
                       <input class="input" type="text" name="ap_materno" value="{{ $alumno->ap_materno }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">CURP:</label>
                    <div class="control">
                        <input class="input" type="text" name="curp" value="{{ $alumno->curp }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Semestre:</label>
                    <div class="control">
                        <input class="input" type="text" name="semestre" value="{{ $alumno->semestre }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Plan de estudios:</label>
                    <div class="control">
                        <div class="select">
                            <select name="plan_estudio_id">
                                <option>Seleccionar carrera</option>
                                @foreach ($planesEstudio as $plan)
                                    <option value="{{ $plan->id }}" @if($plan->id == $alumno->plan_estudio_id) selected @endif>
                                        {{ $plan->carrera }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Estatus:</label>
                    <div class="control">
                        <div class="select">
                            <select name="estatus_alumno_id"> 
                                <option>Seleccionar estatus</option>
                                @foreach ($estatusAlumnos as $estatusAlumno)
                                    <option value="{{ $estatusAlumno->id }}" @if($estatusAlumno->id == $alumno->estatus_alumno_id) selected @endif>
                                        {{ $estatusAlumno->nombre_estatus }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Tipo de Alumno:</label>
                    <div class="control">
                        <div class="select">
                            <select name="tipo_alumno_id">
                                <option>Seleccionar tipo</option>
                                @foreach ($tiposAlumnos as $tipo)
                                    <option value="{{ $tipo->id }}" @if($tipo->id == $alumno->tipo_alumno_id) selected @endif>
                                        {{ $tipo->nombre_tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="has-text-centered">
                    <button class="button is-primary" type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
                    </button>
                    
                </div>
            </form>
        </div>
    </div>

    <button class="modal-close is-large" aria-label="close"></button>
</div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        {{-- Modal para agregar un Alumno --}}
        <div id="modal-nvo-alumno" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Alumno</p>
                    <form method="POST" action="{{route('AlumnoCrear')}}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control">
                                <label class="label">Número de Control:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtNoControl" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Nombre:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtNombre" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Apellido Paterno:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtApPaterno" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Apellido Materno:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtApMaterno" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">CURP:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtCURP" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Semestre:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtSemestre" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Plan de estudios:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtPlan'>
                                            <option>Seleccionar carrera</option>
                                            @foreach ($planesEstudio as $plan)
                                                <option value="{{$plan->id}}">{{ $plan->carrera }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Estatus:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtEstatus'>
                                            <option>Seleccionar estatus</option>
                                            @foreach ($estatusAlumnos as $estatusAlumno)
                                                <option value="{{$estatusAlumno->id}}">{{ $estatusAlumno->nombre_estatus }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Tipo de Alumno:</label>
                                <div class="control">
                                    <div class="select" >
                                        <select name='txtTipoAlumno'>
                                            <option>Seleccionar tipo</option>
                                            @foreach ($tiposAlumnos as $tipo)
                                                <option value="{{$tipo->id}}">{{ $tipo->nombre_tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>


    </div>

@endsection