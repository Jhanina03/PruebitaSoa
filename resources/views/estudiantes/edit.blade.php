@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
    <h1>Editar Estudiante</h1>

    <form action="{{ route('estudiantes.update', $estudiante) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $estudiante->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula:</label>
            <input type="text" name="cedula" id="cedula" class="form-control" value="{{ $estudiante->cedula }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
