<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\MateriaController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\Escolares\DocenteController;

Auth::routes();

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/',[HomeController::class,'index']);

Route::group(['middleware'=> ['role:escolares']],function(){ 
    Route::get('/alumnos',[AlumnoController::class,'index'])->name('Alumnos');
    Route::post('/alumnos/new',[AlumnoController::class,'crearAlumno'])->name('AlumnoCrear');  
    Route::patch('/alumnos/update/{user_id}', [AlumnoController::class, 'actualizarAlumno'])->name('AlumnoActualizar');
    Route::delete('/alumnos/{user_id}', [AlumnoController::class, 'eliminarAlumno'])->name('AlumnoEliminar');

    #Rutas de docentes
    Route::get('/docentes',[DocenteController::class,'index'])->name('Docentes');
    Route::post('/docentes/new',[DocenteController::class,'crearDocente'])->name('DocentesCrear');
    Route::patch('/docentes/editar/{user_id}', [DocenteController::class, 'editarDocente'])->name('DocenteEditar');

});

Route::group(['middleware'=> ['role:division']],function(){ 
 

     

});