<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Juan Perez',
            'email' => 'juan@example.com',
            'password' => Hash::make('password123'),
            'dni' => '12345678A',
            'apellidos' => 'Perez Gomez',
            'telefono' => '123456789',
            'ciudad' => 'Madrid',
            'codigoPostal' => '28001',
            'provincia' => 'Madrid',
            'edad' => 30,
            'sexo' => 'Hombre',
            'esAdmin' => true,
        ]);

        User::create([
            'name' => 'Maria Lopez',
            'email' => 'maria@example.com',
            'password' => Hash::make('password123'),
            'dni' => '87654321B',
            'apellidos' => 'Lopez Martinez',
            'telefono' => '987654321',
            'ciudad' => 'Barcelona',
            'codigoPostal' => '08001',
            'provincia' => 'Barcelona',
            'edad' => 25,
            'sexo' => 'Mujer',
            
        ]);
    }
}
