<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Catalog;
use App\Models\Admin\Product;
use Illuminate\Http\Request;


class CatalogController extends Controller
{

    public function __construct()
    {
        //Подключение модели продукта
        $this->catalog = new Catalog();
        $this->product = new Product();
    }

    public function getProducts($idCatalog, Request $request)
    {

        $catalog = $this->catalog::where('id', $idCatalog)->publish()->first();
        $arrayCatalogs = $catalog->children()->publish()->get();
        if (!empty($arrayCatalogs)) {
            $idCatalogs = array();
            $items = collect($arrayCatalogs)->transform(function ($catalog) use (&$idCatalogs) {
                $idCatalogs[] = $catalog->id;
            });
            $products = Product::whereIn('id_catalog', $idCatalogs)->publish()->get();
            $productsSale = Product::whereIn('id_catalog', $idCatalogs)->publish()->sale()->get();
            $productsNewItems = Product::whereIn('id_catalog', $idCatalogs)->publish()->new()->get();
        } else {
            $products = $catalog->products()->publish()->get();
            $productsSale = $catalog->products()->publish()->sale()->get();
            $productsNewItems = $catalog->products()->publish()->new()->get();
        }




        if (!is_null($products)) {

            return response()->json([
                'success' => true,
                'products' => $products->toArray(),
                'productsSale' => $productsSale->toArray(),
                'productsNewItems' => $productsNewItems->toArray(),
                'message' => ''
            ], 200);

        } else {

            return response()->json([
                'products' => array(),
                'productsSale' => array(),
                'productsNewItems' => array(),
                'success' => false,
                'message' => ''
            ], 404);
        }
    }


}
