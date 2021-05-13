<?php

namespace App\Http\Controllers\Cart;

use App\FormOrder;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Redirect;
use MenaraSolutions\Geographer;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use Illuminate\Support\Facades\Session;
use App\Facades\Order;
use App\Facades\Tinkoff;

class FormOrderController extends Controller
{
    public function __construct()
    {
//        $this->geo = new GeoModel;
//

    }

    public function index()
    {
        $earth = new Earth();
        $russia = $earth->getCountries()->findOne(['code' => 'RU']);
        $cities = $russia->getStates()->setLocale('ru')->sortBy('name')->toArray();
        $isFormOrder = true;

        $formOrder = array();
        return view('form-order.index', compact('formOrder', 'cities', 'isFormOrder'));
    }


    public function success()
    {
        $formOrder = array();
        $isFormOrder = false;
        $response = request()->all();
        $order = array();

        /// Получаем данные заказа их сессии
        if ($response['Success'] === "true") {
            $order = Order::save();
            $order['orderDataResponse'] = $response;
            $paymentId = isset($order['orderDataResponse']['PaymentId']) ? $order['orderDataResponse']['PaymentId'] : "";

            $formOrder = FormOrder::find($order['idOrder']);
            $formOrder->tinkoff_payment_id = $paymentId;
            $formOrder->status = 1;
            $formOrder->save();
            Tinkoff::confirmPayment($paymentId);

        } else {
            $order['orderDataResponse'] = $response;
        }

        return view('form-order.index', compact('formOrder', 'isFormOrder', 'order'));

    }


    public function cancel()
    {
        $formOrder = array();
        $isFormOrder = false;
        $response = request()->all();
        $order = array();

        if ($response['Success'] === "false") {
            $order['orderDataResponse'] = $response;
            $paymentId = isset($order['orderDataResponse']['PaymentId']) ? $order['orderDataResponse']['PaymentId'] : "";
        }
        return view('form-order.index', compact('formOrder', 'isFormOrder', 'order'));

    }


}
