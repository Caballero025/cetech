@extends('layouts.base')

@section('content')
<h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>

<div class="box">
    <div class="buttons">
            <a href="{{ route('home') }}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar</a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-materia"><i
                    class="fa-solid fa-plus"></i>&nbsp;Nuevo</a>
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
                        <td>
                            <div class="field is-grouped">
                                <button class="button is-warning js-modal-trigger" data-target="modal-{{ $materia->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                             
                            </div>
                            
                            <div id="modal-{{ $materia->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Materia</p>
                                        <form method="POST" action="{{ route('MateriasActualizar', $materia->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Clave:</label>
                                                    <div class="control">
                                                        <input class="input" type="text" name = "txtClave" value="{{ $materia->clave_materia }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Nombre de la materia:</label>
                                                    <div class="control">
                                                        <input class="input" type="text" name = "txtNombre" value="{{ $materia->nombre}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="control">
                                                    <label class="label">Créditos:</label>
                                                    <div class="control">
                                                        <input class="input" type="text" name = "txtCreditos" value="{{ $materia->creditos }}">
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
        <div id="modal-nvo-materia" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Materia</p>
                    <form method="POST" action="{{ route('MateriasCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control">
                                <label class="label">Clave:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtClave" value="{{ old('txtClave') }}">
                                </div>
                            </div>
                            @error('txtClave')
                                <p class="help is-danger">Ingresa la clave de la materia</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Nombre de la materia:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtNombre" value="{{ old('txtNombre') }}">
                                </div>
                            </div>
                            @error('txtNombre')
                                <p class="help is-danger">Ingresa el nombre de la materia</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Créditos:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtCreditos" value="{{ old('txtCreditos') }}">
                                </div>
                            </div>
                            @error('txtCreditos')
                                <p class="help is-danger">Ingresa el número de créditos</p>
                            @enderror
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
