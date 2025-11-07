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
                            
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

       

    </div>

@endsection