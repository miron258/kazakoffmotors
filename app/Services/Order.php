<?php

namespace App\Services;

use App\Models\Admin\Product;
use App\Models\Cart\FormOrder\FormOrder;
use App\Models\Cart\FormOrder\FormOrderProduct;
use App\Models\Cart\FormOrder\FormOrderAddressDelivery;
use App\Models\Cart\FormOrder\FormOrderPersonal;
use Composer\DependencyResolver\Transaction;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendFormOrderJob;

class Order
{

    public function __construct()
    {
    }

    public function save()
    {

        $params = session(Session::getId());

        \DB::beginTransaction();
        try {
            $methodDelivery = isset($params['methodDelivery']) ? $params['methodDelivery'] : '';
            $formOrder = new FormOrder();
            $formOrder->text_order = isset($params['textOrder']) ? $params['textOrder'] : '';
            $formOrder->save();
            $formOrderId = $formOrder->id;

            $formOrderPersonal = new FormOrderPersonal();
            $formOrderPersonal->id_order = $formOrderId;
            $formOrderPersonal->save();

            if ($methodDelivery != 1) {
                $formOrderAddressDelivery = new FormOrderAddressDelivery();
                $formOrderAddressDelivery->id_order = $formOrderId;
                $formOrderAddressDelivery->save();
            }
            if (!\Cart::session(Session::getId())->isEmpty()) {
                \Cart::session(Session::getId())->getContent()->each(function ($item) use (&$items, $formOrderId) {
                    $formOrderProducts = new FormOrderProduct();
                    $formOrderProducts->id_product = $item->associatedModel->id;
                    $formOrderProducts->qty = $item->quantity;
                    $formOrderProducts->price = $item->price;
                    $formOrderProducts->name = $item->name;
                    $formOrderProducts->total_price = \Cart::session(Session::getId())->get($item->id)->getPriceSum();
                    $formOrderProducts->attributes = json_encode($item->attributes);
                    $formOrderProducts->id_order = $formOrderId;
                    $formOrderProducts->associated_model = json_encode($item->associatedModel);
                    $formOrderProducts->save();


                    $product = Product::find($item->id);
                    $product->count_stock = (int)$product->count_stock - $item->quantity;
                    $product->save();


                });
                //Чистим корзину
                \Cart::session(Session::getId())->clear();
            }


            \DB::commit();

            ////// Делаем нотификацию для нашей
            ///  формы заказа, тоесть высылаем письмо клиенту и администратору
            ///  о совершенном заказе на сайте
            $result = dispatch(new SendFormOrderJob($formOrder));

            ///Удаляем все данные их сессиии
            session([Session::getId() => '']);
            return array('numOrder' => $formOrder->num_order, 'idOrder' => $formOrderId);


        } catch (Exception $e) {
            \DB::rollBack();
        }






    }


}
