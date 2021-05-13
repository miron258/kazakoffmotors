<?php

namespace App\Mail;

use App\Models\Cart\FormOrder\FormOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormOrderMail extends Mailable
{

    public $formOrder;
    public $theme = 'form-order-theme';
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FormOrder $formOrder)
    {
        $this->formOrder = $formOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message-form-order', ['formOrder' => $this->formOrder]);
    }
}
