<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    // Mostrar todos los estudiantes
    public static function index()
    {
        $estudiantes= Estudiante::with('cursos')->get();
        $cursos = Curso::all();
        return view('estudiantes.index', compact('estudiantes', 'cursos'));
    }
  // Mostrar formulario para crear estudiante
    public static function create()
    {
        return view('estudiantes.create');
    }
    // Guardar un nuevo estudiante
    public static function store(Request $request)
    {
        Estudiante::create(request()->all());
        return redirect()->route('estudiantes.index');
    }
    // Mostrar un solo estudiante
    public static function show(Estudiante $estudiante)
    {
        $cursos= Curso::all();
        return view('estudiantes.show', compact('estudiante', 'cursos'));
    }
    // Mostrar formulario para editar estudiante
    public static function edit(Estudiante $estudiante)
    {
        $cursos = Curso::all();
        return view('estudiantes.edit', compact('estudiante', 'cursos'));
    }
    // Actualizar los datos de un estudiante
    public static function update(Request $request, Estudiante $estudiante)
    {
        // $request->validate([
        // 'nombre'=> 'require|string|max:255',
        // 'cedula'=> 'require|isunique:estudiantes, cedula,'.$estudiante->id, 
        // ]);

        // $estudiante->update($request->all);
        // return redirect()->route('estudiantes.index');  
        $validated= $request->validate([
            'nombre'=> 'require|string|max:255',
            'cedula'=> 'require|isunique:estudiantes, cedula,'.$estudiante->id, 
            ]);
    
            $estudiante->update($validated);
            return redirect()->route('estudiantes.index');  
    }

    // Eliminar un estudiante
    public static function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index');
    }


    public static function agregarCurso(Request $request, Estudiante $estudiante){
        $curso= Curso::find($request->curso_id);
        $estudiante->cursos()->syncWithoutDetaching([$curso->id]);
        $cursos = Curso::all();
        return view ('estudiantes.show', compact('estudiante','cursos'));
    }
    public static function eliminarCurso( Estudiante $estudiante, Curso   $curso){
        $estudiante->cursos()->detach($curso->id);
        $cursos = Curso::all();
        return view ('estudiantes.show', compact('estudiante','cursos'));
    }
}
