<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Events\SearchEvent;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    public function __construct()
    {
        //Подключение модели продукта
        $this->product = new Product;
    }

    public function searchResult(Request $request)
    {

        //Поисковый запрос
        $query = (isset($request->all()['query'])) ? $request->all()['query'] : "";
        $products = $this->product->searchProducts($query, false);

        if (is_null($products)) {
            return response()->json([
                'success' => false,
                'message' => 'По вашему запросу ничего не найдено'
            ], 404);

        } else {
            event(new SearchEvent($products));
            return response()->json([
                'success' => true,
                'message' => ''
            ], 200);
        }
    }


}
