<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Aviso;
class AvisoCadastrado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $aviso;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Aviso $aviso)
    {
        $this->aviso = $aviso;
    }

    public function broadcastWith()
    {
        return [
            'aviso' => $this->aviso,
      ];
  }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('avisos');
    }

}
