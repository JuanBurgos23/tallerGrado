<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class victimaDenuncia extends Model
{
    use HasFactory;
    protected $table = "victimaDenuncia";

    protected $fillable = [
        "id_victima",
        "id_denuncia",
    ];

    //relacion
    public function victima(){
        return $this->belongsTo(victima::class,'id_victima');
    }

    public function denuncia(){
        return $this->belongsTo(denuncia::class,'id_denuncia');
    }
}
