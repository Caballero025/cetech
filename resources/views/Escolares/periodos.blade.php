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
