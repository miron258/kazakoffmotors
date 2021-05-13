<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormOrderRequest;
use App\Models\Cart\FormOrder\FormOrder;
use Illuminate\Support\Facades\Session;
use App\Facades\Tinkoff;
use App\Facades\Order;

class FormOrderController extends Controller
{


    public function saveFormOrder(FormOrderRequest $request)
    {

        $params = $request->all(); //Все данные с инпутов формы
        $methodDelivery = isset($params['methodDelivery']) ? $params['methodDelivery'] : '';
        $methodPayment = isset($params['methodPayment']) ? $params['methodPayment'] : '';
        //Сохраняем все данные в сессию
        session([Session::getId() => $params]);
        ///// Если оплата Онлайн
        if ($methodPayment == 3){
            $latestOrder = FormOrder::orderBy('created_at', 'DESC')->first();
            $latestOrder = (isset($latestOrder->id)) ? $latestOrder->id + 1 : 1;
            $orderId = '#' . str_pad($latestOrder, 8, "0", STR_PAD_LEFT);

            $customerName = $params['name']." ".$params['surname'];
            $phone = isset($params['phone']) ? format_phone($params['phone']) : '';
            $email = isset($params['email']) ? $params['email'] : '';
            $payment= Tinkoff::makePayment($orderId, $phone, $email, $customerName);


            if ($payment['status']){
                return response()->json([
                    'success' => true,
                    'errors' => '',
                    'paymentUrl' => $payment['paymentUrl'],
                    'paymentId' => $payment['paymentId'],
                    'message' => ''
                ], 200);
            }
            if (!$payment['status']){
                return response()->json([
                    'success' => false,
                    'errors' => $payment['errors'],
                    'paymentUrl' => $payment['paymentUrl'],
                    'paymentId' => '',
                    'message' => ''
                ], 404);
            }


        } else {

            $order = Order::save();
            return response()->json([
                'success' => true,
                'errors' => '',
                'numOrder' => $order['numOrder'],
                'cart' => [
                    'total' => 0,
                    'totalSum' => 0,
                    'subTotalSum' => 0,
                    'product' => [],
                    'products' => [],
                    'message' => '',
                ],
                'message' => ''
            ], 200);
        }

    }



}
