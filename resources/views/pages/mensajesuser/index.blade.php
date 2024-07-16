<!-- resources/views/pages/mensajesuser/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mensajes</h1>
    @foreach ($mensajes as $mensaje)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $mensaje->data }}</h5>
                <p class="card-text">{{ $mensaje->created_at->diffForHumans() }}</p>
                <a href="{{ route('mensajeUser.show', $mensaje->id) }}" class="btn btn-primary">Ver mensaje</a>
            </div>
        </div>
    @endforeach
</div>
@endsection