@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
@stop

@section('css')
    {{-- Estilos extra si los necesitas --}}
@stop

@section('js')
    <script>
        console.log("Dashboard cargado con AdminLTE UI");
    </script>
@stop

@section('footer')
    <div class="text-center">
        <strong>Copyright © {{ date('Y') }}
            <a href="#">Restaurante</a>.
        </strong> Todos los derechos reservados.
    </div>
@stop
