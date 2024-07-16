<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = "denuncia";

    protected $fillable = [
        "id",
        "lugar_hecho",
        "fecha_hecho",
        "hora_hecho",
        "instrumento_utilizado",
        "declaracion",
        'id_ubicacion',
        'id_denunciante',
        'id_oficial',
        'id_fiscal',
        'estado',
        'recepcionado',
        'declaracion_formal',
        'id_user',
    ];

    public function denunciante()
    {
        return $this->belongsTo(denunciante::class, 'id_denunciante');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ubicacion()
    {
        return $this->belongsTo(ubicacion::class, 'id_ubicacion');
    }

    public function oficial()
    {
        return $this->belongsTo(oficial::class, 'id_oficial');
    }

    public function fiscal()
{
    return $this->belongsTo(fiscal::class, 'id_fiscal');
}

    public function denunciados()
    {
        return $this->belongsToMany(denunciado::class, 'denunciado_denuncia', 'id_denuncia', 'id_denunciado');
    }

    public function victimas()
    {
        return $this->belongsToMany(victima::class, 'victima_denuncia', 'id_denuncia', 'id_victima');
    }

    public function delitos()
    {
        return $this->belongsToMany(delito::class, 'delito_denuncia', 'id_denuncia', 'id_delito');
    }

    public function evidencias()
    {
        return $this->belongsToMany(evidencia::class, 'evidencia_denuncia', 'id_denuncia', 'id_evidencia');
    }
}
