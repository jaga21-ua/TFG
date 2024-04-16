<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class);
    }
}
