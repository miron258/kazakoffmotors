<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{

    function __construct()
    {

        $this->catalog = new Catalog();
    }

    public function index($url)
    {
        $catalog = Catalog::where('url', $url)->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT
        if (is_null($catalog)) {
            return response()
                ->view(
                    'errors.404',
                    ['message' =>
                        'Ничего не найдено',
                        'meta_tag_title' => 'Ничего не найдено 404'],
                    404);
        } else {


            //Если каталог Родительский
            if (is_null($catalog->parent) || count($catalog->children) > 0) {
                $catalogs = $catalog->children;
                $productsCatalog= Product::wherePopular('1')->with('firstImage')->publish()->limit(5)->orderBy('position', 'asc')->get();



                $catalogHtml = $this->compileBladeString($catalog->html, compact('productsCatalog', 'catalog'));
                return view('catalog.index', compact('catalog', 'catalogs', 'catalogHtml'));
            } else {
                $products = $this->catalog->getProductsInCatalog($catalog, 200);
                return view('catalog.index', compact('catalog', 'products'));
            }
        }
    }


    protected function compileBladeString(string $template, $data = []): string
    {
        $bladeCompiler = app('blade.compiler');
        ob_start() && extract($data, EXTR_SKIP);
        eval("?>" . $bladeCompiler->compileString($template));
        $compiled = ob_get_contents();
        ob_end_clean();
        return $compiled;
    }

}
