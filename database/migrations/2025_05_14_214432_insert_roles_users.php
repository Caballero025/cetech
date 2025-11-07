<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $role = Role::create(['name'=> 'escolares','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'alumno','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'docente','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'admin','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'division','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'rh','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'd_academico','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'vinculacion','guard_name'=> 'web']);
        $role = Role::create(['name'=> 'financieros','guard_name'=> 'web']);
        
        $user = User::create([
            'name' => 'Departamento de Escolares',
            'email' => 'escolares@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('escolares');

        $user = User::create([
            'name' => 'Departamento de Desarrollo Academico',
            'email' => 'd_academico@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('d_academico');

        $user = User::create([
            'name' => 'Departamento de Recursos Humanos',
            'email' => 'rh@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('rh');

        $user = User::create([
            'name' => 'Departamento de Vinculacion',
            'email' => 'vinculacion@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('vinculacion');

        $user = User::create([
            'name' => 'Departamento de Financieros',
            'email' => 'financieros@sjuanrio.tecnm.mx',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole('financieros');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
