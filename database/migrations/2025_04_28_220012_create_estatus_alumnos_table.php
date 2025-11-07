<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EstatusAlumno;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estatus_alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_estatus',30);
        });

        $tipo1 = EstatusAlumno::create([
            'nombre_estatus' => 'Baja Definitiva',
        ]);

        $tipo1 = EstatusAlumno::create([
            'nombre_estatus' => 'Baja Temporal',
        ]);

        $tipo1 = EstatusAlumno::create([
            'nombre_estatus' => 'Egresado',
        ]);

        $tipo1 = EstatusAlumno::create([
            'nombre_estatus' => 'Inscrito',
        ]);

        $tipo1 = EstatusAlumno::create([
            'nombre_estatus' => 'Reinscrito',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estatus_alumnos');
    }
};
