<?php

namespace App\Models\API\Admin;

use App\Models\Admin\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryImg extends Model {

    protected $table = 'gallery_imgs';
    protected $appends = array( 'pathImgThumbnail', 'pathImg');

    public static function boot() {
        parent::boot();
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function(GalleryImg $galleryImg) {
            if (!empty($galleryImg->name)) {
                $path = $galleryImg->gallery->path;
                Storage::delete($path."/".$galleryImg->name);
                Storage::delete($path."/thumbs/".$galleryImg->name);
            }
        });
    }




    static function getGalleryImages($id) {
        $images = GalleryImg::where('id_gallery', $id)->orderBy('position', 'asc')->get();
        return $images;
    }

    static function getImg($id) {
        $image = GalleryImg::where('id', $id)->get()->first();
        return $image;
    }
    public function getPathImgThumbnailAttribute()
    {

        if (isset($this->name)) {
            return $this->attributes['pathImgThumbnail'] = Storage::url( $this->gallery->path."/".$this->name);
        } else {
            return '';
        }

    }
    public function getPathImgAttribute()
    {

        if (isset($this->name)) {
            return $this->attributes['pathImg'] = Storage::url($this->gallery->path."/".$this->name);
        } else {
            return '';
        }

    }
    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'id_gallery');
    }



}
