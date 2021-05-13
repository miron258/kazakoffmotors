<?php

namespace App\Http\Controllers\API\Admin;

use App\Jobs\CurrencyConvertJob;
use App\Models\Admin\Product;

//Model Product
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConvertRequest;
use Swap\Laravel\Facades\Swap;
use App\Facades\CurrencyConverter;
use anlutro\LaravelSettings\SettingStore as Setting;

class ProductController extends Controller
{

    function __construct()
    {
        $this->product = new Product();
    }


    function convert(ConvertRequest $request)
    {

        $amount = round($request->input('priceUsd'), 2);
        $params = $request->all();

        //Добавляем накрутку к цене в долларах
        $wrappingPrice = (isset($params['wrapping'])) ? (int)$request->input('wrapping') : \Setting::all()['wrapping'];
        $price = round($amount * $wrappingPrice / 100 + $amount, 2);


//        dd($price);

        $fromCurrency = $request->input('fromCurrency');
        $toCurrency = $request->input('toCurrency');
        $priceRub = CurrencyConverter::convert($price, 'USD', 'RUB');


        if (($priceRub)) {

            return response()->json([
                'success' => true,
                'price' => $priceRub,
                'message' => 'Цена в долларах плюс <b>' . $wrappingPrice . '%</b> равна <b>' . $price . "</b><br>Сумма в рублях посчитана учитываю проценты"
            ], 200);

        } else {

            return response()->json([
                'price' => 0,
                'success' => false,
                'message' => ''
            ], 404);
        }


    }


    function convertRubToUsdJob()
    {
        dispatch(new CurrencyConvertJob(Product::get()));
        return redirect()->route('product.index')->with('message', 'Конвертер цен у товаров успешно выполнился');
    }


    function updatePosition(){


        $params = request()->all();
        $product = Product::where('id', $params['id_product'])->get()->first();
        $product->position = (isset($params['position']) && $params['position']>0)? $params['position']: 0;
        $res = $product->save();


        if (!is_null($product) && $res){
            return response()->json([
                'products' => Product::all(),
                'success' => true,
                'message' => 'Позиция успешно обновлена'
            ], 200);
        }

        return response()->json([
            'products' => [],
            'success' => false,
            'message' => 'Не удалось обновить позицию'
        ], 404);



    }



    function updatePrice(){


        $params = request()->all();
        $product = Product::where('id', $params['id_product'])->get()->first();
        $product->price = (isset($params['price']) && $params['price']>0)? $params['price']: 0;
        $res = $product->save();


        if (!is_null($product) && $res){
            return response()->json([
                'products' => Product::all(),
                'success' => true,
                'message' => 'Цена успешно обновлена'
            ], 200);
        }

        return response()->json([
            'products' => [],
            'success' => false,
            'message' => 'Не удалось обновить цену'
        ], 404);



    }


    function updatePriceUsd(){


        $params = request()->all();
        $product = Product::where('id', $params['id_product'])->get()->first();
        $priceUsd = (isset($params['price_usd']))? round($params['price_usd'],2): 0;

        $product->price_usd = $priceUsd;


        $amount =$priceUsd;
        //Добавляем накрутку к цене в долларах
        $wrappingPrice = (!empty($product->wrapping) && $product->wrapping>0) ? (int)$product->wrapping : \Setting::all()['wrapping'];
        $price = round($amount * $wrappingPrice / 100 + $amount, 2);
        $priceRub = CurrencyConverter::convert($price, 'USD', 'RUB');

        $product->price = $priceRub;
        $res = $product->save();

        if (!is_null($product) && $res){
            return response()->json([
                'products' => Product::all(),
                'product'=> $product,
                'price'=> $priceRub,
                'success' => true,
                'message' => 'Цена в долларах успешно обновлена'
            ], 200);
        }

        return response()->json([
            'products' => [],
            'success' => false,
            'message' => 'Не удалось обновить цену в долларах'
        ], 404);



    }
    function updateWrapping(){


        $params = request()->all();
        $product = Product::where('id', $params['id_product'])->get()->first();
        $wrappingPrice = (isset($params['wrapping']))? $params['wrapping']: 0;
        $product->wrapping = $wrappingPrice;

        $amount =(!empty($product->price_usd) && $product->price_usd>0)? $product->price_usd: 0;
        //Добавляем накрутку к цене в долларах
        $wrappingPrice = (!empty($wrappingPrice) && $wrappingPrice>0) ? (int)$wrappingPrice : \Setting::all()['wrapping'];
        $price = round($amount * $wrappingPrice / 100 + $amount, 2);
        $priceRub = CurrencyConverter::convert($price, 'USD', 'RUB');


        $product->price = $priceRub;
        $res = $product->save();


        if (!is_null($product) && $res){
            return response()->json([
                'products' => Product::all(),
                'price'=> $priceRub,
                'product'=> $product,
                'success' => true,
                'message' => 'Накрутка для товара успешно обновлена'
            ], 200);
        }

        return response()->json([
            'products' => [],
            'success' => false,
            'message' => 'Не удалось обновить накрутку для товара'
        ], 404);



    }
    function updateCountStock(){


        $params = request()->all();
        $product = Product::where('id', $params['id_product'])->get()->first();
        $product->count_stock = (isset($params['count_stock']))? $params['count_stock']: 0;
        $res = $product->save();


        if (!is_null($product) && $res){
            return response()->json([
                'products' => Product::all(),
                'success' => true,
                'message' => 'Остаток товаров успешно обновлен'
            ], 200);
        }

        return response()->json([
            'products' => [],
            'success' => false,
            'message' => 'Не удалось обновить остаток товаров'
        ], 404);



    }


}
