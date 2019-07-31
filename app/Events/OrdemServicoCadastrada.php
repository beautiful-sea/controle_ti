<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
class OrdemServicoCadastrada implements ShouldBroadcast
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
        return new PrivateChannel('ordem_servicos');
    }

    public function broadcastWith() {
        return [
            'usuario' => User::find($this->ordem_servico->usuario_id)->name,
            'ordem_servico' =>  $this->ordem_servico
      ];
  }
}
