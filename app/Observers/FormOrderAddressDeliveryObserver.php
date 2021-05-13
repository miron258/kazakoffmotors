<?php

namespace App\Observers;

use App\Models\Cart\FormOrder\FormOrder;
use App\Models\Cart\FormOrder\FormOrderAddressDelivery;
use Illuminate\Support\Facades\Session;

class FormOrderAddressDeliveryObserver
{

    /**
     * Handle the post "saving" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function saving(FormOrderAddressDelivery $formOrderAddressDelivery)
    {
        $params = session(Session::getId()); //Все данные с инпутов формы
        //////  Save Data In Table Form Orders Addresses Delivery
        $formOrderAddressDelivery->city = isset($params['city']) ? $params['city'] : '';
        $formOrderAddressDelivery->street = isset($params['street']) ? $params['street'] : '';
        $formOrderAddressDelivery->office = isset($params['office']) ? $params['office'] : '';
        $formOrderAddressDelivery->house_num = isset($params['houseNum']) ? $params['houseNum'] : '';
        $formOrderAddressDelivery->corps = isset($params['corps']) ? $params['corps'] : '';
        $formOrderAddressDelivery->structure = isset($params['structure']) ? $params['structure'] : '';
        $formOrderAddressDelivery->zip_code = isset($params['zipCode']) ? $params['zipCode'] : '';
        ////  END Save Data In Table Form Orders Personals


    }


    /**
     * Handle the form order address delivery "created" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function created(FormOrderAddressDelivery $formOrderAddressDelivery)
    {


    }

    /**
     * Handle the form order address delivery "updated" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function updated(FormOrderAddressDelivery $formOrderAddressDelivery)
    {
        //
    }

    /**
     * Handle the form order address delivery "deleted" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function deleted(FormOrderAddressDelivery $formOrderAddressDelivery)
    {
        //
    }

    /**
     * Handle the form order address delivery "restored" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function restored(FormOrderAddressDelivery $formOrderAddressDelivery)
    {
        //
    }

    /**
     * Handle the form order address delivery "force deleted" event.
     *
     * @param \App\Models\Cart\FormOrder\FormOrderAddressDelivery $formOrderAddressDelivery
     * @return void
     */
    public function forceDeleted(FormOrderAddressDelivery $formOrderAddressDelivery)
    {
        //
    }
}
