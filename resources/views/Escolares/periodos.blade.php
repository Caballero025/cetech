@extends('layouts.base')
@section('content')
    <h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>
    <div class="box ">
        <div class="buttons">
            <a href="{{ route('home') }}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar</a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-periodo"><i
                    class="fa-solid fa-plus"></i>&nbsp;Nuevo Periodo</a>
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
 <div class="field is-grouped">
                                <button class="button is-warning js-modal-trigger" data-target="modal-{{ $periodo->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                               {{--<form action="{{ route('PeriodosEliminar', $periodo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger"
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>--}}
                            </div>

                            <div id="modal-{{ $periodo->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Periodo
                                            {{ $periodo->nombre_periodo . ' ' . substr($periodo->clave_periodo, 0, 2) }}</p>
                                        <form method="POST" action=" {{ route('PeriodosEditar', $periodo->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Año:</label>
                                                    <div class="control">
                                                        <div class="select">
                                                            <select name='txtAnio'>
                                                                <option value="23" {{ substr($periodo->clave_periodo,0,2)== '23' ? 'selected' : '' }}>2023</option>
                                                                <option value="24" {{ substr($periodo->clave_periodo,0,2)== '24' ? 'selected' : '' }}>2024</option>
                                                                <option value="25" {{ substr($periodo->clave_periodo,0,2)== '25' ? 'selected' : '' }}>2025</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Periodo:</label>
                                                    <div class="control">
                                                        <div class="select">
                                                            <select name='txtPeriodo'>
                                                                <option value="1" {{ $periodo->nombre_periodo == 'Enero - Junio' ? 'selected' : '' }}>Enero - Junio</option>
                                                                <option value="2" {{ $periodo->nombre_periodo == 'Agosto - Diciembre' ? 'selected' : '' }}>Agosto - Diciembre</option>
                                                                <option value="V" {{ $periodo->nombre_periodo == 'Verano' ? 'selected' : '' }}>Verano</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Estatus:</label>
                                                    <div class="control">
                                                        <div class="select">
                                                            <select name='txtEstatus'>
                                                                <option value="Cerrado"
                                                                    {{ $periodo->estatus == 'Cerrado' ? 'selected' : '' }}>
                                                                    Cerrado</option>
                                                                <option value="En curso"
                                                                    {{ $periodo->estatus == 'En curso' ? 'selected' : '' }}>
                                                                    En curso</option>
                                                                <option value="Preparación"
                                                                    {{ $periodo->estatus == 'Preparación' ? 'selected' : '' }}>
                                                                    Preparación</option>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
 {{-- Modal para agregar una Materia --}}
        <div id="modal-nvo-periodo" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Periodo</p>
                    <form method="POST" action="{{ route('PeriodosCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control">
                                <label class="label">Año:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name='txtAnio'>
                                            <option>Seleccionar año</option>
                                            <option value="24">2024</option>
                                            <option value="25">2025</option>
                                            <option value="26">2026</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Periodo:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name='txtPeriodo'>
                                            <option>Seleccionar periodo</option>
                                            <option value="1">Enero - Junio</option>
                                            <option value="2">Agosto - Diciembre</option>
                                            <option value="V">Verano</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Estatus:</label>
                                <div class="control">
                                    <div class="select">
                                        <select name='txtEstatus'>
                                            <option>Seleccionar estatus</option>
                                            <option value="Cerrado">Cerrado</option>
                                            <option value="En curso">En curso</option>
                                            <option value="Preparación">Preparación</option>
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
