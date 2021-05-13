<?php

namespace App\Providers;

use App\Models\Cart\FormOrder\FormOrder;
use App\Models\Cart\FormOrder\FormOrderAddressDelivery;
use App\Models\Cart\FormOrder\FormOrderPersonal;
use App\Models\Cart\FormOrder\FormOrderProduct;
use App\Observers\FormOrderAddressDeliveryObserver;
use App\Observers\FormOrderObserver;
use App\Observers\FormOrderPersonalObserver;
use App\Observers\FormOrderProductObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Validator;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });
        /////Регистрируем наш шаблон наблюдателя Observer для модели FormOrder гду мы сохраняем данные формы заказа
        /// Привязывем нашу модель к шаблону наблюдателю чтобы была возможность реагировать на события
        FormOrder::observe(FormOrderObserver::class);
        FormOrderPersonal::observe(FormOrderPersonalObserver::class);
        FormOrderAddressDelivery::observe(FormOrderAddressDeliveryObserver::class);
        FormOrderProduct::observe(FormOrderProductObserver::class);

        Validator::extend('cyrillic', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[А-Яа-яЁё]/u', $value);
        });
    }

}
