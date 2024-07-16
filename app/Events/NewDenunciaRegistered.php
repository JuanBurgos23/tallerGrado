<?php
namespace App\Events;

use App\Models\Denuncia;
use App\Models\Denunciante;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewDenunciaRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $denuncia;
    public $denunciante;

    /**
     * Create a new event instance.
     *
     * @param Denuncia $denuncia
     * @param Denunciante $denunciante
     */

    public function __construct(Denuncia $denuncia, Denunciante $denunciante)
    {
        $this->denuncia = $denuncia;
        $this->denunciante = $denunciante;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('denuncias'); // Nombre del canal de broadcasting
    }
    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'denuncia' => $this->denuncia,
            'denunciante' => $this->denunciante,
        ];
    }
}