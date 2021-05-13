<?php

namespace App\Http\Controllers;

use App\Models\Admin\Gallery;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Admin\Catalog;
use Illuminate\Support\Facades\Session;

class MainController extends Controller {

    public function index(Request $request)
    {

        $gallery = Gallery::with('images')->mainPage()->get()->first();
        $page = Page::where('url', 'main')->first();
        $catalogs = Catalog::whereIn('id', [1, 2, 3, 4])->get();
        return view('index', compact('page', 'catalogs', 'gallery'));
    }

}
