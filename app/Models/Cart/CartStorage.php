<?php
/**
 * Created by PhpStorm.
 * User: darryldecode
 * Date: 1/13/2018
 * Time: 1:25 PM
 */

namespace App\Models\Cart;
use Darryldecode\Cart\CartCollection;
use App\Models\Cart\CartStorageModel;


class CartStorage
{
    public function has($key)
    {
        return CartStorageModel::find($key);
    }
    public function get($key)
    {
        if($this->has($key))
        {
            return new CartCollection(CartStorageModel::find($key)->cart_data);
        }
        else
        {
            return [];
        }
    }
    public function put($key, $value)
    {
        if($row = CartStorageModel::find($key))
        {
            // update
            $row->cart_data = $value;
            $row->save();
        }
        else
        {
            CartStorageModel::create([
                'id' => $key,
                'cart_data' => $value
            ]);
        }
    }
}
