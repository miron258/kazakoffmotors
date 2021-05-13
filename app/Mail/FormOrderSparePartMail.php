<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Form;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormOrderSparePartMail extends Mailable
{
    use Queueable, SerializesModels;
    public $formOrderSparePart;
    public $theme = 'form-order-theme';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $formOrderSparePart)
    {
        $this->formOrderSparePart = $formOrderSparePart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("info@kazakoffmotors.ru")
            ->subject('Форма заказа запчасти')
            ->markdown('emails.message-form-order-spart', ['formOrder' => $this->formOrderSparePart]);
    }
}
