<?php

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Route;
use App\Mail\FormOrderMail;


/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::group(
    [
        'middleware' => ['web', 'cart'],
        'prefix' => 'cart'
//        'namespace' => 'cart'
    ],
    function () {
        Route::get('/form-order/success', 'Cart\FormOrderController@success')->name('cart.success');
        Route::get('/form-order/cancel', 'Cart\FormOrderController@cancel')->name('cart.cancel');
        Route::get('/form-order/{vue?}', 'Cart\FormOrderController@index')->where('vue', '[\/\w\.-]*');
    }
);

Route::group(
    [
        'middleware' => 'web',
        'prefix' => 'cart'
//        'namespace' => 'cart'
    ],
    function () {
/////////////// ROUTING SHOPPING CART, FORM ORDER AND WISHLIST
        Route::get('/', 'Cart\CartController@index')->name('cart.index');


    }
);

Route::group(
    [
        'middleware' => 'web',
//        'prefix' => 'v1',
//                'namespace' => 'cart'
    ],
    function () {

        ///// Text Template Email
        Route::get('email', function () {
            $formOrder = \App\Models\Cart\FormOrder\FormOrder::where('id', 20)->first();
            return new FormOrderMail($formOrder);
        });
        ///// End Text Template Email


//Routing Site
        Route::get('/', 'MainController@index')->name('site.index'); //главная страница сайта
        Route::get('page/{url}', 'PageController@index')->name('page_site.index');
        Route::get('product/{url}', 'ProductController@index')->name('product_site.index');
        Route::get('gallery/{url}', 'GalleryController@index')->name('gallery_site.index');
        Route::get('catalog/{url}', 'CatalogController@index')->name('catalog_site.index');
        Route::get('catalog/{url}/{vue?}', 'CatalogController@index')->where('vue', '[\/\w\.-]*');


        Route::get('material/{url}', 'MaterialController@index')->name('material_site.index');
        Route::get('category/{url}', 'CategoryController@index')->name('category_site.index');
        Route::get('search', 'SearchController@index')->name('search_site.index');
    }
);


Route::get('sendbasicemail', 'MailController@basic_email');
Route::get('sendhtmlemail', 'MailController@html_email');
Route::get('sendattachmentemail', 'MailController@attachment_email');

Auth::routes();


//Группе маршрутов административной панели
//Чтобы войти на страничку эти маршрутов нужно пройти через посредник в данном случае через аутентификацию
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


//Получение данных путем AJAX после авторизации пользователя
//Route::get('admin/table_products', [
//    'middleware'=>'auth',
//'uses'=>'Admin\ProductController@tableProducts']);


Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'admin' //Добавляет префик к каждому маршруту в данном случае
        //  Route::resource('page', 'Admin\PageController'); равняется  Route::resource('admin/page', 'Admin\PageController');
    ]
    , function () {


//Здесь перечислены группы наших маршрутов
    //К каждому начала маршрута добавляется префикс admin

    Route::resource('formOrder', 'Admin\FormOrderController');
    Route::resource('page', 'Admin\PageController');
    Route::resource('catalog', 'Admin\CatalogController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('product', 'Admin\ProductController');
    Route::resource('gallery', 'Admin\GalleryController');
    Route::resource('material', 'Admin\MaterialController');
    Route::resource('menu', 'Admin\MenuController');



    Route::get('settings_site', 'Admin\SettingSiteController@index')->name('settings_site.index');
    Route::put('settings_site', 'Admin\SettingSiteController@save')->name('settings_site.save');


    Route::get('list_pages', 'Admin\PageController@getPages'); //Получать список статических страни
    Route::get('table_pages', 'Admin\PageController@tablePages'); //Шаблон таблицы со списком страниц


    Route::get('list_materials', 'Admin\MaterialController@getMaterials'); //Получать список материалов
    Route::get('table_materials', 'Admin\MaterialController@tableMaterials'); //Шаблон таблицы со списком материалов


    Route::get('list_products', 'Admin\ProductController@getProducts'); //Получать список товаров



    Route::get('table_products', 'Admin\ProductController@tableProducts'); //Шаблон таблицы со списком товаров
});




