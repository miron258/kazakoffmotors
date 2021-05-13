<?php

namespace App\Services;

use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use Kenvel\Tinkoff;

class TinkoffPayments
{

    public $apiUrl = "https://securepay.tinkoff.ru/v2/";
    public $terminal = "1615883711671";
    public $secretKey = 'egi7d3s25utt9tvc';
    public $tinkoff;

    public function __construct()
    {
        $this->tinkoff = new Tinkoff($this->apiUrl, $this->terminal, $this->secretKey);

    }

    public function makePayment($orderId, $phone, $email, $customerName)
    {


        $totalOrder = \Cart::session(Session::getId())->getTotal();
        $vats = [
            'none' => 'none', // Без НДС
            'vat0' => 'vat0', // НДС 0% ЭТО НАША
            'vat10' => 'vat10', // НДС 10%
            'vat18' => 'vat18' // НДС 18%
        ];
        $taxations = [
            'osn' => 'osn', // Общая СН
            'usn_income' => 'usn_income', // Упрощенная СН (доходы) ЭТО НАША
            'usn_income_outcome' => 'usn_income_outcome', // Упрощенная СН (доходы минус расходы)
            'envd' => 'envd', // Единый налог на вмененный доход
            'esn' => 'esn', // Единый сельскохозяйственный налог
            'patent' => 'patent' // Патентная СН
        ];


//Подготовка массива с данными об оплате
        $payment = [
            'OrderId' => $orderId,        //Ваш идентификатор платежа
            'Amount' => $totalOrder,           //сумма всего платежа в рублях
            'Language' => 'ru',            //язык - используется для локализации страницы оплаты
            'Description' => 'Оплата заказа Мотосервис Казакофф Моторс',   //описание платежа
            'Email' => (!empty($email)) ? $email : "",//email покупателя
            'Phone' => (!empty($phone)) ? $phone : "",   //телефон покупателя
            'Name' => (!empty($customerName)) ? $customerName : "", //Имя покупателя
            'Taxation' => $taxations['usn_income']     //Налогооблажение
        ];

//подготовка массива с покупками

        $items = [];
        $i = 0;
        $cartCollection = \Cart::session(Session::getId())->getContent()->sort()->map(function ($item) use (&$items, &$i, &$vats) {
            $items[$i]['Name'] = $item->name;
            $items[$i]['Price'] = \Cart::session(Session::getId())->get($item->id)->getPriceSum();
            $items[$i]['NDS'] = $vats['none'];
            $i++;
        });


        $paymentURL = $this->tinkoff->paymentURL($payment, $items);

        //Контроль ошибок
        if (!$paymentURL) {
            return array('status' => false, 'paymentUrl' => false, 'errors' => $this->tinkoff->error);
        } else {
            return array('status' => true, 'paymentUrl' => $paymentURL, 'errors' => '', 'paymentId' => $this->tinkoff->payment_id);
        }

    }

    function confirmPayment($payment_id)
    {
        $status = $this->tinkoff->confirmPayment($payment_id);
        //Контроль ошибок
        if (!$status) {
            return array('status' => false, 'message' => $this->tinkoff->error);
        } else {
            return array('status' => true, 'message' => $status);
        }
    }

    function cancelPayment($payment_id)
    {
        $status = $this->tinkoff->cencelPayment($payment_id);

        //Контроль ошибок
        if (!$status) {
            return array('status' => false, 'message' => $this->tinkoff->error);
        } else {
            return array('status' => true, 'message' => $status);
        }
    }


}
