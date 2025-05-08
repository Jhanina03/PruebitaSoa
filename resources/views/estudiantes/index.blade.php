<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
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

                    <!-- Formulario para agregar curso -->
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
    </div>
</body>
</html>
