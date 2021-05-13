<?php

namespace App\Observers;
use App\Models\Cart\FormOrder\FormOrder;
use Illuminate\Support\Facades\Session;

class FormOrderObserver
{

    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function saving(FormOrder $formOrder)
    {
        $params = session(Session::getId()); //Все данные с инпутов формы
        $methodDelivery = isset($params['methodDelivery']) ? $params['methodDelivery'] : '';//Способо доставки
        $methodPayment = isset($params['methodPayment']) ? $params['methodPayment'] : ''; //Способо оплаты

        $formOrder->delivery_method = $methodDelivery;
        $formOrder->payment_method = $methodPayment;


        ///// генерируем уникальный номер заказа
        $latestOrder = FormOrder::orderBy('created_at', 'DESC')->first();
        $latestOrder = (isset($latestOrder->id)) ? $latestOrder->id + 1 : 1;
        $formOrder->num_order = '#' . str_pad($latestOrder, 8, "0", STR_PAD_LEFT);
        $formOrder->total_order = \Cart::session(Session::getId())->getTotal();
    }

    /**
     * Handle the form order "created" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function created(FormOrder $formOrder)
    {


    }

    /**
     * Handle the form order "updated" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function updated(FormOrder $formOrder)
    {
        //
    }

    /**
     * Handle the form order "deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function deleted(FormOrder $formOrder)
    {
        //
    }

    /**
     * Handle the form order "restored" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function restored(FormOrder $formOrder)
    {
        //
    }

    /**
     * Handle the form order "force deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrder  $formOrder
     * @return void
     */
    public function forceDeleted(FormOrder $formOrder)
    {
        //
    }
}
