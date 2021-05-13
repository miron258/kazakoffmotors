<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormOrderSparePartRequest;
use App\Mail\FormOrderSparePartMail;
use App\Models\Form;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{


    public function saveFormSpart(FormOrderSparePartRequest $request)
    {
        $params = $request->all(); //Все данные с инпутов формы

        //// Save Form Spare Part
        $form = new form;
        $form->spart = isset($params['spart']) ? $params['spart'] : '';
        $form->phone = isset($params['phone']) ? $params['phone'] : '';
        $form->email = isset($params['email']) ? $params['email'] : '';
        $form->type_form = 'formorderspart';
        $form->name = isset($params['name']) ? $params['name'] : '';
        $form->save();
        //// End Save Form Spare Part

//отправляем уведомление администратору сайта
        Mail::to(['miron258@yandex.ru'])->send(new FormOrderSparePartMail($form));
        return response()->json([
            'success' => true,
            'errors' => '',
            'message' => 'Спасибо за заказ, наш менеджер свяжется с Вами в ближайшее время.',
            'form' => '',
        ], 200);

    }

}
