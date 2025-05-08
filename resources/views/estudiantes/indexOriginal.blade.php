@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Estudiantes</h1>
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">Agregar Estudiante</a>
    </div>

    @if($estudiantes->isEmpty())
        <p>No hay estudiantes registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Cursos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->cedula }}</td>
                        <td>
                            @foreach($estudiante->cursos as $curso)
                                <span class="badge bg-secondary">{{ $curso->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{-- <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-sm btn-warning">Editar</a> --}}
                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea eliminar este estudiante?')">Eliminar</button>
                            </form>
                            <a href="{{ route('estudiantes.show', $estudiante) }}" class="btn btn-sm btn-info">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
