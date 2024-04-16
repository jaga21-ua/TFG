<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class);
    }
}
