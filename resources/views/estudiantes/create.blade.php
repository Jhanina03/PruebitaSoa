@extends('layouts.app')

@section('title', 'Agregar Estudiante')

@section('content')
    <h1>Agregar Nuevo Estudiante</h1>

    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" name="cedula" id="cedula" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
