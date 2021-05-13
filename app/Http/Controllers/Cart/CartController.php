<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImg;
use App\Models\Cart\FormOrder\FormOrderProduct;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct() {
        //Подключение модели продукта
        $this->product = new Product;
        $this->productImg = new ProductImg;
    }

    public function index()
    {

        $cart = array();
        $productsPopular= Product::wherePopular('1')->with('firstImage')->publish()->limit(5)->get();
        return view('cart.index', compact('cart', 'productsPopular'));
    }


}
