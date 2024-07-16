<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class denunciado extends Model
{
    use HasFactory;

    protected $table = "denunciado";
    protected $fillable = [
        "id",
        "nombreDenunciado",
        "apellidos",
        "ci",
        "fecha_nac",
        "estado_civil",
        "sexo",
        "edad",
        "nacionalidad",
        "descripcion",
    ];
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellidos}";
    }
}
