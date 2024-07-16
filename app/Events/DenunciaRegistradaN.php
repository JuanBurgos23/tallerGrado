<?php

namespace App\Events;

use App\Models\Denuncia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DenunciaRegistradaN implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $denuncia;

    public function __construct(Denuncia $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('denuncias');
    }
}
