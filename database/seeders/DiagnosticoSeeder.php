<?php

// DiagnosticoSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diagnostico;

class DiagnosticoSeeder extends Seeder
{
    public function run()
    {
        Diagnostico::create([
            'user_id' => 1,
            'texto_diagnostico' => 'Gripe común',
            'gravedad' => 'leve',
            'sintomas' => 'fiebre, tos, dolor de cabeza',
            'tratamiento' => 'paracetamol, descanso'
        ]);

        Diagnostico::create([
            'user_id' => 2,
            'texto_diagnostico' => 'Alergia estacional',
            'gravedad' => 'moderada',
            'sintomas' => 'estornudos, ojos llorosos, congestión nasal',
            'tratamiento' => 'antihistamínicos, evitar alérgenos'
        ]);
    }
}
