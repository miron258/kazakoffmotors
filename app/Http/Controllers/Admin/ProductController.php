<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Thumbs;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CatalogController as Catalog;
use App\Jobs\CurrencyConvertJob;
use anlutro\LaravelSettings\SettingStore as Setting;
use App\Providers\ImgThumbnailsServiceProvider;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog as CatalogModel;
use App\Models\Admin\ProductImg;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest as ProductRequest;
use Illuminate\Support\Facades\Storage;
use Transliterate;

class ProductController extends Controller
{

    public function __construct()
    {
        //Подключение модели продукта
        $this->product = new Product;
        $this->productImg = new ProductImg;
    }

    //AJAX QUERY

    public function tableProducts()
    {
        return view('auth.product.table');
    }

    public function getProducts(Request $request)
    {

        $numPage = $request->input('page'); //Номер страницы
        $idCatalog = $request->input('idCatalog');
        $price = $request->input('price');
        $name = $request->input('name');
        $art = $request->input('art');

        return $products = $this->product->getAllProducts(1500, $idCatalog, $price, $name, $art);
    }

    //END AJAX QUERY

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $catalogs = CatalogModel::get()->toTree();
        return view('auth.product.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CatalogModel $catalog, Request $request)
    {

        $arrayCheckbox = array(
            'sale' => 'Распродажа',
            'new' => 'Новинка',
            'popular' => 'Популярный'
        );
        $settings = (object) \Setting::all();

        $catalogs = CatalogModel::get()->toTree();
        return view('auth.product.form', compact('catalogs', 'arrayCheckbox', 'settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $product = new Product();
        $product->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $product->meta_tag_description = $params['meta_tag_description'];
        $product->meta_tag_keywords = $params['meta_tag_keywords'];
        $product->name = $params['name'];
        $product->url = rtrim(Transliterate::slugify(trim($params['name']))."-".$params['art']);
        $product->id_catalog = $params['id_catalog'];
        $product->anons = isset($params['anons']) ? $params['anons'] : '';
        $product->position = isset($params['position']) ? $params['position'] : 0;
        $product->wrapping = isset($params['wrapping']) ? $params['wrapping'] : \Setting::all()['wrapping'];
        $product->price_usd = isset($params['price_usd']) ? $params['price_usd'] : 0;
        $product->description = $params['description'];
        $product->video = $params['video'];
        $product->properties = isset($params['properties']) ? $params['properties'] : '';


        /////////// ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ
        $product->equipment = isset($params['equipment']) ? $params['equipment'] : '';
        $product->compatibility = isset($params['compatibility']) ? $params['compatibility'] : '';
        /////////// КОНЕЦ ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ


        $product->count_stock = $params['count_stock'];
        $product->art = $params['art'];
        $product->price = $params['price'];
        $product->old_price =isset($params['old_price']) ? $params['old_price'] : 0;


        //Рейтинг товара и доступность на складе
        $product->sale = $request->has('sale');
        $product->new = $request->has('new');
        $product->popular = $request->has('popular');
        $product->availability = 1;
        $product->index = 1;
        $product->hidden = 1;
        $product->author = $user->name;
        $product->update_author = $user->name;
        $product->save();
        $images = array();

        if ($files = $request->file('images')) {
            foreach ($files as $index => $file) {
                $path = $request->images[$index]->store('products');
                Thumbs::setThumbs($path, 'products', 800, 800, 200, 200);


                ///Insert Data Img Product
                $productImg = new ProductImg();
                $productImg->name = basename($path);
                $productImg->alt = $product->name;
                $productImg->hidden = 1;
                $productImg->id_product = $product->id;
                $productImg->save();
            }


        }

        return redirect()->route('product.create')->with('message', 'Продукт успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('auth.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $arrayCheckbox = array(
            'hidden' => 'Показать/Скрыть товар',
            'index' => 'Показать/Скрыть из поиска',
            'sale' => 'Распродажа',
            'new' => 'Новинка',
            'popular' => 'Популярный',
            'availability' => 'Наличие товара'
        );

        $settings = (object) \Setting::all();
        $catalogs = CatalogModel::get()->toTree();
        $productImages = $product->images()->get();

        return view('auth.product.form', compact('product', 'catalogs', 'productImages', 'arrayCheckbox', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();




        $id = $params['productId'];
        $product = Product::find($id);
        $author = $product->author;

        $product->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $product->meta_tag_description = $params['meta_tag_description'];
        $product->meta_tag_keywords = $params['meta_tag_keywords'];
        $product->name = $params['name'];
//        $product->url = (empty($params['url']))? Transliterate::slugify(trim($params['name'])): trim($params['url']);

        $product->url =  $params['url'];

        $product->id_catalog = $params['id_catalog'];
        $product->anons =  isset($params['anons']) ? $params['anons'] : '';
        $product->description = $params['description'];
        $product->video = $params['video'];
        $product->properties = isset($params['properties']) ? $params['properties'] : '';
        $product->position = isset($params['position']) ? $params['position'] : 0;
        $product->price_usd = isset($params['price_usd']) ? $params['price_usd'] : 0;
        $product->wrapping = isset($params['wrapping']) ? $params['wrapping'] : \Setting::all()['wrapping'];
        $product->count_stock = $params['count_stock'];
        $product->art = $params['art'];
        $product->price = $params['price'];
        $product->old_price = isset($params['old_price']) ? $params['old_price'] : 0;

        /////////// ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ
        $product->equipment = $params['equipment'];
        $product->compatibility = $params['compatibility'];
        /////////// КОНЕЦ ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ


        //Рейтинг товара и доступность на складе
        $product->sale = $request->has('sale');
        $product->new = $request->has('new');
        $product->popular = $request->has('popular');
        $product->availability = $request->has('availability');
        $product->index = $request->has('index');
        $product->hidden = $request->has('hidden');
        $product->author = $author;
        $product->update_author = $user->name;
        $product->save();

        if ($files = $request->file('images')) {

            //Удаляем все старые изображения привязанные к товару
            $oldImages = $product->images()->publish()->get();
            foreach ($oldImages as $index => $img) {
                $isDelete = ProductImg::find($img->id)->delete();
            }

            ///Загрузка новых изображений для товара
            foreach ($files as $index => $file) {
                $path = $request->images[$index]->store('products');
                Storage::makeDirectory('products/thumbs');
                Thumbs::setThumbs($path, 'products', 800, 800, 200, 200);


                ///Insert Data Img Product
                $productImg = new ProductImg();
                $productImg->name = basename($path);
                $productImg->alt = $product->name;
                $productImg->hidden = 1;
                $productImg->id_product = $product->id;
                $productImg->save();
            }
        }


        return redirect()->route('product.edit', $product->id)->with('message', 'Продукт ' . $product->name . ' успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        if ($ids && !empty($ids)) {
            $ids = explode(",", $ids);
            Product::find($ids)->each(function ($product, $key) {
                $product->delete();
            });

            $products = $this->product->getAllProducts();
            return response()->json([
                'success' => true,
                'products' => $products,
                'message' => '<div class="alert alert-success">Товар(ы) успешно удалены</div>',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => '<div class="alert alert-danger">Не удалось удалить товар(ы)</div>',
            ], 500);
        }
    }

}
