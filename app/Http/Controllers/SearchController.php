<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function __construct()
    {
        //Подключение модели продукта
        $this->product = new Product;
    }

    public function index(Request $request)
    {
        $search = [];

        //Поисковый запрос
        $query = (isset($request->all()['query'])) ? $request->all()['query'] : "";

        if (!empty($query)) {
            $products = $this->product->searchProducts($query);

            if (is_null($products)) {
                return response()
                    ->view(
                        'search.index',
                        [
                            'products' => $products,
                            'search' => $search,
                            'message' => 'По вашему запросу ничего не найдено', 'meta_tag_title' => 'По вашему запросу ничего не найдено'
                        ],
                        200);
            } else {

                return view('search.index', compact('products', 'search', 'query'));
            }
        } else {
            return response()
                ->view(
                    'search.index',
                    [
                        'products' => '',
                        'search' => $search,
                        'message' => 'По вашему запросу ничего не найдено', 'meta_tag_title' => 'По вашему запросу ничего не найдено'
                    ],
                    200);
        }
    }

}
