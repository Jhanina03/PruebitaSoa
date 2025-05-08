<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;

class EstudianteController2 extends Controller
{
    public static function index()
    {
        $estudiantes= Estudiante::with('cursos')->get();
        $cursos = Curso::all();
        return view('estudiantes.index', compact('estudiantes', 'cursos'));
    }
    public static function create()
    {
        return view('estudiantes.index');
    }
    public static function store(Request $request)
    {
        Estudiante::create(request()->all());
        return redirect()->route('estudiantes.index');
    }
    public static function show(Estudiante $estudiante)
    {
        $cursos= Curso::all();
        return view('estudiantes.index', compact('estudiante', 'cursos'));
    }

    public static function edit(Estudiante $estudiante)
    {
        $cursos = Curso::all();
        return view('estudiantes.index', compact('estudiante', 'cursos'));
    }

    public static function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
        'nombre'=> 'require|string|max:255',
        'cedula'=> 'require|isunique:estudiantes, cedula,'.$estudiante->id, 
        ]);

        $estudiante->update($request->all);
        return redirect()->route('estudiantes.index');  
    }

    public static function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index');
    }

    public static function agregarCurso(Request $request, Estudiante $estudiante){

        $curso= Curso::find($request->curso_id);

        $estudiante->cursos()->syncWithoutDetaching([$curso->id]);
        $cursos = Curso::all();
        $estudiantes=Estudiante::all()->find($estudiante->id);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante agregado correctamente.');
    }
    public static function eliminarCurso( Estudiante $estudiante, Curso   $curso){
        $estudiante->cursos()->detach($curso->id);
        $cursos = Curso::all();
        return redirect()->route('estudiantes.index')->with('success', 'Curso eliminado correctamente.');
    }
}
