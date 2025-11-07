@extends('layouts.base')

@section('content')
    <h3 class="title is-3 has-text-centered">Sistema Integral de Información</h3>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Panel principal</p>
        </header>
        <div class="card-content">
            <div class="content">
                <div class="columns is-multiline is-mobile">
                    @include('home.escolares')
                    @include('home.alumno')
                    @include('home.docente')
                    @include('home.division')
                </div>
            </div>
        </div>
    </div>
@endsection
