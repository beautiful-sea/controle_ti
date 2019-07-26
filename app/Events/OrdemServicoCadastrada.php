<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrdemServicoCadastrada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ordem_servico;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ordem_servico)
    {
        $this->ordem_servico = $ordem_servico;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ordem_servicos');
    }

    public function broadcastWith() {
        return [
            'usuario' => App\User::find($this->ordem_servico->usuario_id)->name,
      ];
  }
}
