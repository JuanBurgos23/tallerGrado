<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class victima extends Model
{
    use HasFactory;

    protected $table = "victima";

    protected $fillable = [
        "id",
        "nombre",
        "apellidos",
        "ci",
        "fecha_nac",
        "estado_civil",
        "ocupacion",
        "sexo",
        "edad",
        "nacionalidad",
    ];
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellidos}";
    }
    
    public function denuncias()
    {
        return $this->belongsToMany(Denuncia::class, 'victima_denuncia', 'id_victima', 'id_denuncia');
    }

}
