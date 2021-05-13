<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    function __construct()
    {

        $this->product = new Product();
    }

    //Page view Product
    public function index($url)
    {
        $product = Product::with('images', 'catalog')->where('url', $url)->publish()->first();

        if (is_null($product)) {
            return response()
                ->view(
                    'errors.404',
                    ['message' =>
                        'Ничего не найдено',
                        'meta_tag_title' => 'Ничего не найдено 404'],
                    404);
        } else {
            $productImages = $product->images()->publish()->get();
            $catalog = $product->catalog()->first(); //Получаем текущий каталог
            $products =$catalog->products()->with('firstImage')->publish()->get(); //Получаем все продукты этого каталога
            return view('product.index', compact('product', 'products', 'productImages'));

        }

    }

}
