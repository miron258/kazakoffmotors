<?php

namespace App\Notifications;

use App\Mail\FormOrderMail;
use App\Models\Admin\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CurrencyConvertNotification extends Notification
{
    use Queueable;
    private $products;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($products)
    {

        $this->products = $products;


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
            ->subject('Мотосервис Казакофф Моторс, конвертация цен')
            ->markdown('emails.message-convert-currency', ['products' => $this->products]);


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
