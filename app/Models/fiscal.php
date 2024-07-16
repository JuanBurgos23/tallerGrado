<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class fiscal extends Model
{
    use HasFactory, Notifiable;
    protected $table = "fiscal";

    protected $fillable = [
        "id",
        "nombre",
        "paterno",
        "materno",
        "telefono",
        "correo",
    ];

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->paterno} {$this->materno}";
    }
    //enviar correo
    public function routeNotificationForMail()
    {
        return $this->correo;
    }

    
}
