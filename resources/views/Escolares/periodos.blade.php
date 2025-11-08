@extends('layouts.base')
@section('content')
    <h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>
    <div class="box ">
        <div class="buttons">
            <a href="{{ route('home') }}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar</a>
            
        </div>
        @if (session('Correcto'))
            <div class="notification is-success">
                <button class="delete"></button>
                {{ session('Correcto') }}
            </div>
        @endif

        @if (session('Incorrecto'))
            <div class="notification is-danger">
                <button class="delete"></button>
                {{ session('Incorrecto') }}
            </div>
        @endif

        <table class="table is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Periodo</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->clave_periodo }}</td>
                        <td>{{ $periodo->nombre_periodo }}</td>
                        <td>{{ $periodo->estatus }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endsection
