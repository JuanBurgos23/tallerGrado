<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evidencia extends Model
{
    use HasFactory;

    protected $table = "evidencia";

    protected $fillable = [
        "id",
        "path",
        
    ];
    // Relación con denuncias
    public function denuncias()
    {
        return $this->belongsToMany(Denuncia::class, 'evidencia_denuncia', 'id_evidencia', 'id_denuncia');
    }
}
