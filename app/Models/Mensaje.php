<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{

    protected $fillable = [
        'diagnostico_id',
        'texto',
        'es_persona',
        'user_id',
        'fecha',
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class);
    }
}
