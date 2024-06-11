<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
        'nregistro',
        'nombre',
        'photo',
        'pactivos',
        'labtitular',
        'estado',
        'cpresc',
        'comerc',
        'receta',
        'conduc',
        'triangulo',
        'huerfano',
        'biosimilar',
        'viasAdministracion',
        'dosis'
    ];
    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnostico::class);
    }
}
