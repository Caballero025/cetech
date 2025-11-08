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
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th class="is-hidden-mobile">Apellido Paterno</th>
                    <th class="is-hidden-mobile">Apellido Materno</th>
                    <th class="is-hidden-mobile is-hidden-tablet">CURP</th>
                    <th class="is-hidden-mobile">E-Mail</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $item)
                    <tr>
                        <td>{{ $item->rfc }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td class="is-hidden-mobile">{{ $item->ap_paterno }}</td>
                        <td class="is-hidden-mobile">{{ $item->ap_materno }}</td>
                        <td class="is-hidden-mobile is-hidden-tablet">{{ $item->curp }}</td>
                        <td class="is-hidden-mobile">{{ $item->email }}</td>
                        <td>
                            

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    
@endsection
