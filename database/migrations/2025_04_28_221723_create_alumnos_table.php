<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_de_control', 15)->unique();
            $table->string('nombre');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('curp', 18);
            $table->tinyInteger('semestre');
            $table->unsignedBigInteger('plan_estudio_id');
            $table->unsignedBigInteger('estatus_alumno_id');
            $table->unsignedBigInteger('tipo_alumno_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('plan_estudio_id')
                ->references('id')->on('planes_estudio');

            $table->foreign('estatus_alumno_id')
                ->references('id')->on('estatus_alumnos');

            $table->foreign('tipo_alumno_id')
                ->references('id')->on('tipo_alumnos');

            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
