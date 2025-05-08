@extends('layouts.app')

@section('title', 'Gestión de Estudiantes')

@section('content')
    <h1>Gestión de Estudiantes</h1>

    <!-- Formulario para agregar un nuevo estudiante -->
    <h2>Agregar Estudiante</h2>
    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="cedula">Cédula:</label>
            <input type="text" name="cedula" id="cedula" required>
        </div>
        <button type="submit">Agregar Estudiante</button>
    </form>

    <hr>

    <h3>Estudiantes Registrados</h3>
    @if($estudiantes->isEmpty())
        <p>No hay estudiantes registrados.</p>
    @else
        @foreach($estudiantes as $estudiante)
            <div>
                <h4>{{ $estudiante->nombre }} (Cédula: {{ $estudiante->cedula }})</h4>

                <!-- Cursos Asignados -->
                <h5>Cursos Asignados:</h5>
                @if($estudiante->cursos->isEmpty())
                    <p>No hay cursos asignados a este estudiante.</p>
                @else
                    <ul>
                        @foreach($estudiante->cursos as $curso)
                            <li>
                                {{ $curso->nombre }}
                                <form action="{{ route('estudiantes.eliminarCurso', [$estudiante->id, $curso->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Desea eliminar este curso del estudiante?')">Eliminar Curso</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <!-- Formulario para agregar curso al estudiante -->
                <h5>Agregar Curso:</h5>
                <form action="{{ route('estudiantes.agregarCurso', $estudiante->id) }}" method="POST">
                    @csrf
                    <div>
                        <label for="curso_id_{{ $estudiante->id }}">Seleccione un curso:</label>
                        <select name="curso_id" id="curso_id_{{ $estudiante->id }}">
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit">Agregar Curso</button>
                </form>

                <hr>
            </div>
        @endforeach
    @endif
@endsection
