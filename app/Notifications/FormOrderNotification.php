<?php

namespace App\Notifications;

use App\Mail\FormOrderMail;
use App\Models\Cart\FormOrder\FormOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormOrderNotification extends Notification
{
    use Queueable;
    private $formOrder;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(FormOrder $formOrder)
    {

        $this->formOrder = $formOrder;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        return (new MailMessage)
//            ->from('info@sometimes-it-wont-work.com', 'Admin')
            ->subject('Мотосервис Казакофф Моторс')
            ->markdown('emails.message-form-order', ['formOrder' => $this->formOrder]);


    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
