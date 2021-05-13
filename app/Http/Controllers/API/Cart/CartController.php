<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class CartController extends Controller
{


    public function add(Request $request)
    {

        $product = $request->product;
        $id = $product['id'];
        $qty = $product['qty'];
        $price = $product['price'];
        $properties = isset($product['properties']) ? $product['properties'] : array();
        $productCart = \Cart::session(Session::getId())->get($id);
        $product = Product::find($id);
        $name = $product->fullname;


        if (!empty($productCart)) {
            $type = 'update';
            \Cart::session(Session::getId())->update($id, [
                'attributes' => $properties,
                'quantity' => array(
                    'relative' => true,
                    'value' => $qty
                ),
                'price' => $price
            ]);
        } else {
            $type = 'add';

            $productData = array(
                'id'=> $id,
                'name'=> $name,
                'price' => $price,
                'quantity'=> $qty,
                'attributes'=> $properties,
                'associatedModel' => $product
            );
            \Cart::session(Session::getId())->add($productData);

        }

        $response = array(
            'success' => true,
            'type' => $type,
            'total' => \Cart::session(Session::getId())->getTotalQuantity(),
            'totalSum' => \Cart::session(Session::getId())->getTotal(),
            'subTotalSum' => \Cart::session(Session::getId())->getSubTotal(),
            'product' => $product,
            'products' => $this->getCart(),
            'message' => "Товар $name в количестве $qty
             добавлен  в корзину товаров."
        );

        return response($response, 200, []);


    }

    public function update(Request $request)
    {
        $product = $request->product;
        $id = $product['id'];
        $qty = $product['qty'];
        $productCart = \Cart::session(Session::getId())->get($id);



        $name = $productCart->name;
        $type = "update";


        if (!empty($productCart)) {
            // update the item on cart
            \Cart::session(Session::getId())->update($id, [
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty
                )
            ]);


            return response(array(
                'success' => true,
                'total' => \Cart::session(Session::getId())->getTotalQuantity(),
                'totalSum' => \Cart::session(Session::getId())->getTotal(),
                'subTotalSum' => \Cart::session(Session::getId())->getSubTotal(),
                'product' => $productCart,
                'products' => $this->getCart(),
                'type' => $type,
                'message' => "Товар $name в количестве $qty
             обновлен  в корзине товаров."
            ), 200, []);

        }

        return response(array(
            'success' => false,
            'isCart' => false,
            'total' => \Cart::session(Session::getId())->getTotalQuantity(),
            'totalSum' => \Cart::session(Session::getId())->getTotal(),
            'subTotalSum' => \Cart::session(Session::getId())->getSubTotal(),
            'product' => $productCart,
            'products' => $this->getCart(),
            'type' => $type,
            'message' => "Не удалось обновить кол-во товара $name"
        ), 200, []);

    }


    public function getCartContents(Request $request)
    {

        $qtyProductInCart = \Cart::session(Session::getId())->getTotalQuantity();
        return response(array(
            'success' => true,
            'type' => 'getCart',
            'total' => $qtyProductInCart,
            'totalSum' => \Cart::session(Session::getId())->getTotal(),
            'subTotalSum' => \Cart::session(Session::getId())->getSubTotal(),
            'products' => $this->getCart(),
            'message' => "В вашей корзине $qtyProductInCart товаров"
        ), 200, []);
    }

    protected function getCart()
    {
        $cartCollection = \Cart::session(Session::getId())->getContent()->sortBy(function ($item) use (&$items) {

            $item->attributes['summedPrice'] = \Cart::session(Session::getId())->get($item->id)->getPriceSum();
            $item->attributes['isCart'] = (!empty(\Cart::session(Session::getId())->get($item->id))) ? true : false;
        });
        return $cartCollection;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {

            \Cart::session(Session::getId())->remove($id);

            return response(array(
                'success' => true,
                'data' => $id,
                'type' => 'delete',
                'total' => \Cart::session(Session::getId())->getTotalQuantity(),
                'totalSum' => \Cart::session(Session::getId())->getTotal(),
                'subTotalSum' => \Cart::session(Session::getId())->getSubTotal(),
                'products' => $this->getCart(),
                'product' => $product,
                'message' => "Товар $product->name успешно удален из корзины товаров!"
            ), 200, []);

        } else {
            return response(array(
                'success' => false,
                'data' => $id,
                'message' => "Товар $product->name не удалось удалить из корзины товаров."
            ), 200, []);
        }

    }

    public function addCondition()
    {
        $userId = 1; // get this from session or wherever it came from

        /** @var \Illuminate\Validation\Validator $v */
        $v = validator(request()->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'target' => 'required|string',
            'value' => 'required|string',
        ]);

        if ($v->fails()) {
            return response(array(
                'success' => false,
                'data' => [],
                'message' => $v->errors()->first()
            ), 400, []);
        }

        $name = request('name');
        $type = request('type');
        $target = request('target');
        $value = request('value');

        $cartCondition = new CartCondition([
            'name' => $name,
            'type' => $type,
            'target' => $target, // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $value,
            'attributes' => array()
        ]);

        \Cart::session(Session::getId())->condition($cartCondition);

        return response(array(
            'success' => true,
            'data' => $cartCondition,
            'message' => "condition added."
        ), 201, []);
    }

    public function clearCartConditions()
    {
        $userId = 1; // get this from session or wherever it came from

        Cart::session(Session::getId())->clearCartConditions();

        return response(array(
            'success' => true,
            'data' => [],
            'message' => "cart conditions cleared."
        ), 200, []);
    }


    public function details()
    {
        $userId = 1; // get this from session or wherever it came from

        // get subtotal applied condition amount
        $conditions = \Cart::session(Session::getId())->getConditions();


        // get conditions that are applied to cart sub totals
        $subTotalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'subtotal';
        })->map(function (CartCondition $c) use ($userId) {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        // get conditions that are applied to cart totals
        $totalConditions = $conditions->filter(function (CartCondition $condition) {
            return $condition->getTarget() == 'total';
        })->map(function (CartCondition $c) {
            return [
                'name' => $c->getName(),
                'type' => $c->getType(),
                'target' => $c->getTarget(),
                'value' => $c->getValue(),
            ];
        });

        return response(array(
            'success' => true,
            'data' => array(
                'total_quantity' => \Cart::session(Session::getId())->getTotalQuantity(),
                'sub_total' => \Cart::session(Session::getId())->getSubTotal(),
                'total' => \Cart::session(Session::getId())->getTotal(),
                'cart_sub_total_conditions_count' => $subTotalConditions->count(),
                'cart_total_conditions_count' => $totalConditions->count(),
            ),
            'message' => "Get cart details success."
        ), 200, []);
    }
}
