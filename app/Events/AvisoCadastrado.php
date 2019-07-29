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
use App\Setor;


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
            'aviso' => $this->buscaESubstituiComandosNoAviso($this->aviso),
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

    public function buscaESubstituiComandosNoAviso($aviso){
        $aviso->titulo = str_replace('{SETOR}', Setor::find(auth()->user()->setor_id)->name, $aviso->titulo);
        
        $aviso->descricao = str_replace('{SETOR}', Setor::find(auth()->user()->setor_id)->name, $aviso->descricao);

        $nome_usuario = explode(' ',auth()->user()->name);
        $aviso->titulo = str_replace('{COLABORADOR}', $nome_usuario[0], $aviso->titulo);

        $nome_usuario = explode(' ',auth()->user()->name);
        $aviso->descricao = str_replace('{COLABORADOR}', $nome_usuario[0], $aviso->descricao);

        return $aviso;
    }

}
