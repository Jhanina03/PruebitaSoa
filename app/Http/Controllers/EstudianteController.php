<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        //
        $estudiantes= Estudiante::with('cursos')->get();
        $cursos = Curso::all();
        return view('estudiantes.index', compact('estudiantes', 'cursos'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create()
    {
        //
        return view('estudiantes.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(Request $request)
    {
        //

        Estudiante::create(request()->all());
        return redirect()->route('estudiantes.index');
    }

    /**
     * Display the specified resource.
     */
    public static function show(Estudiante $estudiante)
    {
        //
        $cursos= Curso::all();
        return view('estudiantes.show', compact('estudiante', 'cursos'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public static function edit(Estudiante $estudiante)
    {
        //
        $cursos = Curso::all();
        return view('estudiantes.show', compact('estudiante', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public static function update(Request $request, Estudiante $estudiante)
    {
        //

        $request->validate([
        'nombre'=> 'require|string|max:255',
        'cedula'=> 'require|isunique:estudiantes, cedula,'.$estudiante->id, 
        ]);

        $estudiante->update($request->all);
        return redirect()->route('estudiantes.index');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy(Estudiante $estudiante)
    {
        //

        // $estudiante = estudiante::find($id);
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
