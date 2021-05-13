<?php

namespace App\Observers;

use App\Models\Cart\FormOrder\FormOrderProduct;
use Illuminate\Support\Facades\Session;

class FormOrderProductObserver
{

    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function saving(FormOrderProduct  $formOrderProduct)
    {


    }

    /**
     * Handle the form order product "created" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function created(FormOrderProduct $formOrderProduct)
    {
        //
    }

    /**
     * Handle the form order product "updated" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function updated(FormOrderProduct $formOrderProduct)
    {
        //
    }

    /**
     * Handle the form order product "deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function deleted(FormOrderProduct $formOrderProduct)
    {
        //
    }

    /**
     * Handle the form order product "restored" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function restored(FormOrderProduct $formOrderProduct)
    {
        //
    }

    /**
     * Handle the form order product "force deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderProduct  $formOrderProduct
     * @return void
     */
    public function forceDeleted(FormOrderProduct $formOrderProduct)
    {
        //
    }
}
