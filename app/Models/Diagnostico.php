<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{

    protected $fillable = [
        'user_id',
        'sintomas',
        'texto_diagnostico',
        'gravedad',
        'tratamiento',
        
    ];

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
