<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImgThumbnails
{

    public function __construct()
    {


    }

    protected function saveResizeImg($width, $height, $path, $folderStorage)
    {
        $fileName = basename($path);
        $img = Image::make('storage/' . $path);
        $img->height() > $img->width() ? $width = null : $height = null;
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save('storage/' . $folderStorage . '/' . $fileName);
    }


    function setThumbs($path, $folderStorage, $width = 800, $height = 600, $widthThumb = 400, $heightThumb = 400)
    {
        Storage::makeDirectory($folderStorage . '/thumbs');
        $this->saveResizeImg($width, $height, $path, $folderStorage);
        $this->saveResizeImg($widthThumb, $heightThumb, $path, $folderStorage."/thumbs");
    }


}
