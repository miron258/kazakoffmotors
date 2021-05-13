<?php

namespace App\Observers;
use App\Models\Cart\FormOrder\FormOrder;
use App\Models\Cart\FormOrder\FormOrderPersonal;
use Illuminate\Support\Facades\Session;


class FormOrderPersonalObserver
{

    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function saving(FormOrderPersonal  $formOrderPersonal)
    {
        $params = session(Session::getId()); //Все данные с инпутов формы
        $formOrderPersonal->name = isset($params['name']) ? $params['name'] : '';
        $formOrderPersonal->surname = isset($params['surname']) ? $params['surname'] : '';
        $formOrderPersonal->phone = isset($params['phone']) ? $params['phone'] : '';
        $formOrderPersonal->email = isset($params['email']) ? $params['email'] : '';
    }

    /**
     * Handle the form order personal "created" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function created(FormOrderPersonal $formOrderPersonal)
    {

    }

    /**
     * Handle the form order personal "updated" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function updated(FormOrderPersonal $formOrderPersonal)
    {
        //
    }

    /**
     * Handle the form order personal "deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function deleted(FormOrderPersonal $formOrderPersonal)
    {
        //
    }

    /**
     * Handle the form order personal "restored" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function restored(FormOrderPersonal $formOrderPersonal)
    {
        //
    }

    /**
     * Handle the form order personal "force deleted" event.
     *
     * @param  \App\Models\Cart\FormOrder\FormOrderPersonal  $formOrderPersonal
     * @return void
     */
    public function forceDeleted(FormOrderPersonal $formOrderPersonal)
    {
        //
    }
}
