<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use App\Models\API\Admin\GalleryImg;
use Illuminate\Http\Request;


class GalleryController extends Controller
{

    public function __construct()
    {
        //Подключение модели продукта
        $this->gallery = new Gallery();
        $this->galleryImg = new GalleryImg();
    }

    public function getGallery($idGallery, Request $request)
    {
        $gallery = Gallery::with('images')->where('id', (int) $idGallery)->publish()->get()->first();

        if (!is_null($gallery)) {
            if($gallery->children){
                return response()->json([
                    'success' => true,
                    'isParent'=> true,
                    'parentGallery' => $gallery,
                    'galleries' => $gallery->children->toArray(),
                    'message' => ''
                ], 200);
            }

            return response()->json([
                'success' => true,
                'isParent'=> false,
                'parentGallery' => false,
                'galleries' => $gallery->toArray(),
                'message' => ''
            ], 200);

        }

        return response()->json([
            'gallery' => $gallery,
            'images' => array(),
            'success' => false,
            'message' => ''
        ], 404);

    }


}
