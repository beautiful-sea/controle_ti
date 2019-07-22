<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ChangedStatusOrdemServico extends Notification
{
    use Queueable;

    private $ordem_servico_id;

    private $new_status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ordem_servico_id,$new_status)
    {
        $this->ordem_servico_id = $ordem_servico_id;
        $this->new_status = $new_status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'ordemServico'   =>$this->ordem_servico_id,
            'newStatus'      =>$this->new_status,
            'changedBy'     =>  auth()->user()
        ];
    }
}
