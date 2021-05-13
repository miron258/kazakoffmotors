<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Admin\Gallery; //Model Gallery
use App\Models\API\Admin\GalleryImg; //Model Gallery Images
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryImgRequest;
use Illuminate\Http\Request;
use App\Facades\Thumbs;
use Illuminate\Support\Facades\Storage;

class DropzoneGalleryController extends Controller {

    function upload(GalleryImgRequest $request) {

        $image = $request->file('image');

        ///Создаем папку с название нашей галереи
        $idGallery = $request->id_gallery;
        $gallery = Gallery::find($idGallery);

        if ($image) {

            $path = $request->file('image')->store($gallery->path);
            Thumbs::setThumbs($path, $gallery->path, 800, 800, 200, 200);

            /*             * *** Save Database img **** */
            $image = new GalleryImg();
            $image->name = basename($path);
            $image->alt = $request->alt;
            $image->position = isset($request->position)? $request->position:0;
            $image->id_gallery = $idGallery;
            $image->save();
            /*             * *** End Save Database img **** */

            $images = GalleryImg::getGalleryImages($idGallery);
            return response()->json([
                        'success' => true,
                        'images' => $images,
                        'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Изображение загружено/div>',
                            ], 200);
        } else {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Не удалось загрузить изображение</div>',
                            ], 500);
        }
    }

    //Получить все изображения конкретной галереи
    function getImages($idGallery) {
        $images = GalleryImg::getGalleryImages($idGallery);
        if (is_null($images)) {

            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Не удалось найти изображения к галерее</div>',
                            ], 404);
        }

        return response()->json([
                    'success' => true,
                    'images' => $images,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Изображения успешно получены</div>',
                        ], 200);
    }

    function saveImg($idImg, Request $request) {
        $itemCollection = collect($request->images);
        $filtered = $itemCollection->filter(function($item) use ($idImg) {
            if ((int) $item['id'] === (int) $idImg ) {
               return $item;

            }
        });

        $findImage = (object) array_values($filtered->toArray())[0];
        if (!empty($findImage)) {

            $image = GalleryImg::getImg($idImg);
            $image->alt = $findImage->alt;
            $image->position = $findImage->position;
            $image->save();

            return response()->json([
                'success' => true,
                'images' => $images = GalleryImg::getGalleryImages($image->id_gallery),
                'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Изображение успешно обновлено</div>',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Не удалось найти изображение</div>',
        ], 404);


    }

    function delete($idImg) {
        $image = GalleryImg::getImg($idImg);

        if (is_null($image)) {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Не удалось найти изображение</div>',
                            ], 404);
        }
        $idGallery = $image->id_gallery;
        $image->delete(); //Удаляем запись из базы данных

        return response()->json([
                    'success' => true,
                    'images' => $images = GalleryImg::getGalleryImages($idGallery),
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Изображение успешно удалено</div>',
                        ], 200);
    }

}
