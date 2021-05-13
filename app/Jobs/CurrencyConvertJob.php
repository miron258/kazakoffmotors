<?php

namespace App\Jobs;

use App\Facades\CurrencyConverter;
use App\Models\Admin\Product;
use App\Notifications\CurrencyConvertNotification;
use App\Notifications\FormOrderNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CurrencyConvertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $products;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //// Производим конвертация цен
        $productsConverted = CurrencyConverter::globalConvert();

        //// Уведомляем администратора о произведенной конвертации
        $admin = User::where('id', 1)->first();

        ///Передаем в нотификацию список сконвертированных товаров
        $admin->notify(new CurrencyConvertNotification($productsConverted));


//        $this->products->notify(new CurrencyConvertNotification($this->products));
    }


    ////// Метод выполняется при неудачном выполнении задания
    public function failed(){

    }
}
