<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mensaje;
use Carbon\Carbon;

class MensajeSeeder extends Seeder
{
    public function run()
    {
        Mensaje::create([
            'fecha' => Carbon::now(),
            'texto' => 'Tengo fiebre y tos desde hace dos días.',
            'es_persona' => true,
            'user_id' => 1,
            'diagnostico_id' => 1,
        ]);

        Mensaje::create([
            'fecha' => Carbon::now(),
            'texto' => 'Parece una gripe común. Recomiendo paracetamol y descanso.',
            'es_persona' => false,
            'user_id' => null,
            'diagnostico_id' => 1,
        ]);

        Mensaje::create([
            'fecha' => Carbon::now(),
            'texto' => 'Estoy estornudando mucho y tengo los ojos llorosos.',
            'es_persona' => true,
            'user_id' => 2,
            'diagnostico_id' => 2,
        ]);

        Mensaje::create([
            'fecha' => Carbon::now(),
            'texto' => 'Podría ser alergia estacional. Prueba con antihistamínicos.',
            'es_persona' => false,
            'user_id' => null,
            'diagnostico_id' => 2,
        ]);
    }
}
