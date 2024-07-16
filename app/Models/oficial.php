<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class oficial extends Model
{
    use HasFactory, Notifiable;
    protected $table = "oficial";

    protected $fillable = [
        "id",
        "name",
        "paterno",
        "materno",
        "telefono",
        "email",
        "cargo",
    ];
    public function getNombreCompletoAttribute()
    {
        return "{$this->name} {$this->paterno} {$this->materno}";
    }
    public function routeNotificationForMail()
    {
        return $this->email;
    }
   
}
