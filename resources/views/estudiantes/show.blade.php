@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
    <h1>Detalle del Estudiante</h1>

    <p><strong>Nombre:</strong> {{ $estudiante->nombre }}</p>
    <p><strong>Cédula:</strong> {{ $estudiante->cedula }}</p>

    <h3>Cursos Asignados</h3>
    @if($estudiante->cursos->isEmpty())
        <p>No hay cursos asignados.</p>
    @else
        <ul class="list-group mb-3">
            @foreach($estudiante->cursos as $curso)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $curso->nombre }}
                    <form action="{{ route('estudiantes.eliminarCurso', [$estudiante->id, $curso->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar este curso del estudiante?')">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif

    <h3>Agregar Curso</h3>
    <form action="{{ route('estudiantes.agregarCurso', $estudiante->id) }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="curso_id" class="form-label">Seleccione un curso:</label>
            <select name="curso_id" id="curso_id" class="form-select" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Agregar Curso</button>
    </form>

    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Volver al Listado</a>
@endsection
