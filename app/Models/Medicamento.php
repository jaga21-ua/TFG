<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnostico::class);
    }
}
