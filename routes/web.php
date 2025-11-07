<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\MateriaController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Http\Controllers\Escolares\AlumnoController;

Auth::routes();

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/',[HomeController::class,'index']);

Route::group(['middleware'=> ['role:escolares']],function(){ 
    Route::get('/alumnos',[AlumnoController::class,'index'])->name('Alumnos');
    Route::post('/alumnos/new',[AlumnoController::class,'crearAlumno'])->name('AlumnoCrear');

});

Route::group(['middleware'=> ['role:division']],function(){ 
    Route::get('/materias',[MateriaController::class,'index'])->name('Materias');
    Route::post('/materias/new',[MateriaController::class,'crearMateria'])->name('MateriasCrear');
    Route::patch('/materias/{id}',[MateriaController::class,'actuaMateria'])->name('MateriasActualizar');
    Route::delete('/materias/{id}', [MateriaController::class, 'eliminarMateria'])->name('MateriasEliminar');

    # Rutas para la gestión de planes de estudio
    Route::get('/planes-de-estudio',[PlanEstudioController::class,'index'])->name('PlanesEstudio');
    Route::post('/planes-de-estudio/new',[PlanEstudioController::class,'crearPlanEstudio'])->name('PlanesEstudioCrear');
    Route::delete('/planes-de-estudio/delete/{id}',[PlanEstudioController::class,'eliminarPlanEstudio'])->name('PlanesEstudioEliminar');
    Route::patch('/planes-de-estudio/update/{id}',[PlanEstudioController::class,'actualizarPlanEstudio'])->name('PlanesEstudioActualizar');

     

});