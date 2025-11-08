@extends('layouts.base')
@section('content')

<h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>
    <div class="box ">
        <div class="buttons">
            <a href="{{ route('home') }}" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar</a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-docente"><i
                    class="fa-solid fa-plus"></i>&nbsp;Nuevo Docente</a>
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
                            <div class="field is-grouped">
                                <button class="button is-warning js-modal-trigger" data-target="modal-{{ $item->user_id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('DocenteEliminar', $item->user_id) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form> 
                            </div>
                            
                            <div id="modal-{{ $item->user_id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Docente</p>
                                        <form method="POST" action=" {{ route('DocenteEditar', $item->user_id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">RFC:</label>
                                                <div class="control">
                                                    <input class="input" type="text"
                                                        value="{{ $item->rfc }}" name = "txtRFC">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre:</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="{{ $item->nombre }}"
                                                        name = "txtNombre">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Paterno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="{{ $item->ap_paterno }}"
                                                        name = "txtApPaterno">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Materno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="{{ $item->ap_materno }}"
                                                        name = "txtApMaterno">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">CURP:</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="{{ $item->curp }}"
                                                        name = "txtCURP">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">E-Mail:</label>
                                                <div class="control">
                                                    <input class="input" type="text" value="{{ $item->email }}"
                                                        name = "txtEmail">
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
  {{-- Modal para agregar un Docente --}}
        <div id="modal-nvo-docente" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Docente</p>
                    <form method="POST" action="{{ route('DocentesCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control">
                                <label class="label">RFC:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtRFC" value="{{ old('txtRFC') }}">
                                </div>
                            </div>
                            @error('txtRFC')
                                <p class="help is-danger">Ingresa el RFC</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Nombre:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtNombre" value="{{ old('txtNombre') }}">
                                </div>
                            </div>
                            @error('txtNombre')
                                <p class="help is-danger">Ingresa el nombre</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Apellido Paterno:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtApPaterno" value="{{ old('txtApPaterno') }}">
                                </div>
                            </div>
                            @error('txtApPaterno')
                                <p class="help is-danger">Ingresa el apellido paterno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">Apellido Materno:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtApMaterno" value="{{ old('txtApMaterno') }}">
                                </div>
                            </div>
                            @error('txtApMaterno')
                                <p class="help is-danger">Ingresa el apellido materno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">CURP:</label>
                                <div class="control">
                                    <input class="input" type="text" name = "txtCURP" value="{{ old('txtCURP') }}">
                                </div>
                            </div>
                            @error('txtCURP')
                                <p class="help is-danger">Ingresa la CURP</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">E-Mail:</label>
                                <div class="control">
                                    <input class="input" type="email" name = "txtEmail" value="{{ old('txtEmail') }}">
                                </div>
                            </div>
                            @error('txtEmail')
                                <p class="help is-danger">Ingresa el email</p>
                            @enderror
                        </div>
                        

                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                    <!-- Your content -->
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>




    </div>

    @if ($errors->has('txtRFC') || $errors->has('txtNombre') || $errors->has('txtApPaterno') || $errors->has('txtApMaterno') || $errors->has('txtCURP') || $errors->has('txtEmail')  )
        <script>
            document.getElementById('modal-nvo-docente').classList.add('is-active');
        </script>
    @endif
    
@endsection
