<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // importa tu modelo User
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario de prueba solo si no existe
        User::firstOrCreate(
            ['email' => 'test@example.com'], // condición única
            [
                'name' => 'Test User',
                'password' => bcrypt('secret'), // siempre hashea la contraseña
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Puedes agregar más seeds aquí usando firstOrCreate para evitar duplicados
        // Por ejemplo:
        // User::firstOrCreate(
        //     ['email' => 'admin@example.com'],
        //     ['name' => 'Admin User', 'password' => bcrypt('admin123')]
        // );
    }
}

