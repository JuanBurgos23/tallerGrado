<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evidenciaDenuncia extends Model
{
    use HasFactory;

    protected $table = "evidenciaDenuncia";

    protected $fillable = [
        "id_evidencia",
        "id_denuncia",
    ];

    //relacion
    public function evidencia(){
        return $this->belongsTo(evidencia::class,'id_evidencia');
    }

    public function denuncia(){
        return $this->belongsTo(denuncia::class,'id_denuncia');
    }
}
