<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\API\Admin\MenuItems;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
        [
            'middleware' => 'api',
            'prefix' => 'v1',
            'namespace' => 'API'
        ],
        function() {

            Route::post('/search-result','SearchController@searchResult')->name('search.products-result');

            Route::get('/cart/is-product-in-cart','Cart\CartController@isProductInCart')->name('cart.isProductInCart');
            Route::get('/cart/content','Cart\CartController@getCartContents')->name('cart.content');
            Route::post('/cart/save-form-order', 'Cart\FormOrderController@saveFormOrder');


            Route::post('/cart','Cart\CartController@add')->name('cart.add');
            Route::post('/cart/update','Cart\CartController@update')->name('cart.update');
            Route::post('/cart/conditions','Cart\CartController@addCondition')->name('cart.addCondition');
            Route::delete('/cart/conditions','Cart\CartController@clearCartConditions')->name('cart.clearCartConditions');
            Route::get('/cart/details','Cart\CartController@details')->name('cart.details');
            Route::delete('/cart/{id}','Cart\CartController@delete')->name('cart.delete');
            Route::post('/cart/get-link-payment', 'Cart\FormOrderController@getLinkPayment')->name('form_order.online-payment');



            Route::post('/product/convert','Admin\ProductController@convert')->name('product.convert');

            /// Глобальная конвертация цен
            Route::get('/product/convert-rub-to-usd','Admin\ProductController@convertRubToUsdJob')->name('product.convert-rub-to-usd');

            Route::post('/product/update-position','Admin\ProductController@updatePosition')->name('product.update-position');
            Route::post('/product/update-price','Admin\ProductController@updatePrice')->name('product.update-price');
            Route::post('/product/update-price-usd','Admin\ProductController@updatePriceUsd')->name('product.update-price-usd');
            Route::post('/product/update-count-stock','Admin\ProductController@updateCountStock')->name('product.update-count-stock');
            Route::post('/product/update-wrapping','Admin\ProductController@updateWrapping')->name('product.update-wrapping');

            Route::get('/getProducts/{id}','CatalogController@getProducts')->name('catalog.products');
            Route::get('/getGallery/{id}','GalleryController@getGallery')->name('gallery.images');


            Route::group(['prefix' => 'wishlist'],function()
            {
                Route::get('/','Cart\WishListController@index')->name('wishlist.index');
                Route::post('/','Cart\WishListController@add')->name('wishlist.add');
                Route::get('/details','Cart\WishListController@details')->name('wishlist.details');
                Route::delete('/{id}','Cart\WishListController@delete')->name('wishlist.delete');
            });
/////////////// END ROUTING SHOPPING CART AND WISHLIST



            Route::post('saveformorder', 'FormController@saveFormOrder');
            Route::post('saveformspart', 'FormController@saveFormSpart');


    Route::apiResource('menuitems', 'Admin\MenuItemsController');
    Route::get('listitems/{idMenu}', 'Admin\MenuItemsController@listItems')->name('menuitems.list');
    Route::get('listitemsexclude/{idMenu}/{idItem}', 'Admin\MenuItemsController@listItemsExclude')->name('menuitemsexclude.list');



    //MENU ITEMS
    Route::get('menu_items', function() {
        return view('auth.menuitems.index');
    })->name('menitems.index');

    Route::get('menu_items_select_options', function() {
        return view('auth.menuitems.select_options_menu_items');
    })->name('menitemsselectoptions.index');

    //MENU ITEM SELECT OPTIONS
    Route::get('menu_items_form', function() {
        return view('auth.menuitems.form');
    })->name('menitems.form');

    Route::get('menu_items_nodes', function() {
        return view('auth.menuitems.nodes_renderer');
    })->name('menitems.nodes');



    //List Route For Upload Img Gallery
    Route::get('galleryimages', function() {
        return view('auth.galleryimgs.list-imgs');
    })->name('gallery.images');
    Route::post('dropzone/upload', 'Admin\DropzoneGalleryController@upload')->name('dropzone.upload'); //Загрузка изображения
    Route::get('dropzone/images/{idGallery}', 'Admin\DropzoneGalleryController@getImages')->name('dropzone.images'); //Получить список изображения
    Route::delete('dropzone/delete/{idImg}', 'Admin\DropzoneGalleryController@delete')->name('dropzone.delete'); //Удалить изображение
    Route::post('dropzone/save/{idImg}', 'Admin\DropzoneGalleryController@saveImg')->name('dropzone.save'); //Сохранить данные изображения
    //End List Route For Upload Img Gallery
});
