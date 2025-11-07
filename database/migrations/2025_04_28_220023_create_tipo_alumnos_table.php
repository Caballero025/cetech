<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TipoAlumno;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo',30);
            
        });

        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Cambio de Carrera',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Convalidación',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Equivalencia',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Equivalencia/Reingreso',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Movilidad',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Nuevo Ingreso',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Re-Ingreso',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Revalidación',
        ]);
        $tipo1 = TipoAlumno::create([
            'nombre_tipo' => 'Traslado',
        ]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_alumnos');
    }
};
