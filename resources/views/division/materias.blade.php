@extends('layouts.base')

@section('content')
<h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>

<div class="box">
    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Nombre Materia</th>
                <th>Créditos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr>
                    <td>{{ $materia->clave_materia }}</td>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->creditos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
