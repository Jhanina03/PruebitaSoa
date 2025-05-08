<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EstudianteController2;
use App\Http\Controllers\EstudianteControllerIndex2;
use Illuminate\Support\Facades\Route;

// Rutas de recursos para el controlador EstudianteController
Route::resource('estudiantes', EstudianteController2::class);

// Ruta para agregar un curso a un estudiante
Route::post('/estudiantes/{estudiante}/agregarCurso', [EstudianteController2::class, 'agregarCurso'])->name('estudiantes.agregarCurso');

// Ruta para eliminar un curso de un estudiante
Route::delete('/estudiantes/{estudiante}/eliminarCurso/{curso}', [EstudianteController2::class, 'eliminarCurso'])->name('estudiantes.eliminarCurso');
