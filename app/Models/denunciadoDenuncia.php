<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class denunciadoDenuncia extends Model
{
    use HasFactory;
    protected $table = "denunciadoDenuncia";
    protected $fillable = [
        "id_denunciado",
        "id_denuncia",
    ];

    //relacion
    public function denunciado(){
        return $this->belongsTo(denunciado::class,'id_denunciado');
    }

    public function denuncia(){
        return $this->belongsTo(denuncia::class,'id_denuncia');
    }
}
