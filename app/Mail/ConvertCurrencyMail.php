<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Admin\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConvertCurrencyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $products;
    public $theme = 'form-order-theme';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
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
            ->subject('Глобальная конвертация цен')
            ->markdown('emails.message-convert-currency', ['products' => $this->products]);
    }
}
