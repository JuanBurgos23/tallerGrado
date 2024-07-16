<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class denunciante extends Model
{
    use HasFactory;
    protected $table = "denunciante";

    protected $fillable = [
        "id",
        "ci",
        "nombre",
        "paterno",
        "materno",
        "sexo",
        "domicilio",
        "telefono",
        "edad",
        "estado_civil",
        "fecha_nac",
        "nacionalidad",
        "natural_de",
        "ocupacion",
    ];

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->paterno} {$this->materno}";
    }
}
