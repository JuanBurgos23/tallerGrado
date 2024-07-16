<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\denuncia;

class delito extends Model
{
    use HasFactory;

    protected $table = "delito";

    protected $fillable = [
        "id",
        "nombre",
    ];

    public function denuncias()
    {
        return $this->belongsToMany(Denuncia::class, 'delito_denuncia', 'id_delito', 'id_denuncia');
    }
}
