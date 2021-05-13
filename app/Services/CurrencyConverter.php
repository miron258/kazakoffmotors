<?php

namespace App\Services;

use App\Models\Admin\Product;
use Swap\Laravel\Facades\Swap;
use anlutro\LaravelSettings\SettingStore as Setting;

class CurrencyConverter
{

    public function __construct()
    {
    }

    public function convert($amount, $to, $from)
    {
        $convert = $to . '/' . $from;
        $rate = round(Swap::latest($convert)->getValue(), 3);
        $value = (int)preg_replace("~\..+~", '', ceil($rate * $amount));

        if ($value) {
            return $value;
        } else {
            return false;
        }

    }


    public function globalConvert()
    {
        $products = Product::get();
        $productsConverted = array();
        $i = 0;
        $items = collect($products)->each(function ($product, $key) use (&$products, &$productsConverted, &$i) {
            if ($product->price_usd != 0 && !empty($product->price_usd)) {
                $productCurrent = Product::find($product->id);
                $productsConverted[$i] = $product;

                $wrappingPrice = (isset($product->wrapping) && !is_null($product->wrapping)) ? (int)$product->wrapping : \Setting::all()['wrapping'];
                $price = round($product->price_usd * $wrappingPrice / 100 + $product->price_usd, 2);

                $priceRub = $this->convert($price, 'USD', 'RUB');
                $productsConverted[$i]['new_price'] = $priceRub;
                $productCurrent->price = $priceRub;
                $productCurrent->save();
                $i++;
            }
        });
        return $productsConverted;

    }


}
