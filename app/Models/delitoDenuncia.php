<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delitoDenuncia extends Model
{
    use HasFactory;

    protected $table = "delitoDenuncia";

    protected $fillable = [
        "id_delito",
        "id_denuncia",
    ];

    //relacion
    public function delito(){
        return $this->belongsTo(delito::class,'id_delito');
    }

    public function denuncia(){
        return $this->belongsTo(denuncia::class,'id_denuncia');
    }
}
