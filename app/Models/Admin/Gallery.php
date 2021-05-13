<?php

namespace App\Models\Admin;

use App\Models\API\Admin\GalleryImg;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Gallery extends Model
{
    use NodeTrait;

    protected $primarykey = 'id';


    ///Hidden Скрыть конкретные ячейки массива при отдаче данных JSON или можно указать свойство protected $visible с перечеслением только видимых ячеек
//    protected $hidden = ['name', 'header', 'id'];
    protected $guarded = ['lft', 'rgt', 'parent_id'];
    protected $appends = array('isMain', 'datePublish');

    //EVENTS ELOQUENT MODEL
    public static function boot()
    {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function (Gallery $gallery) {
            $images = $gallery->images()->get();
            if (!empty($images)) {
                foreach ($images as $index => $image) {
                    $isDelete = GalleryImg::find($image->id)->delete();
                }
            }

        });
    }

    public function getIsMainAttribute()
    {

        $isMainPage = Gallery::where('is_main_page', 1)->get()->first();
        if ($isMainPage) {
            return $this->attributes['isMain'] = 1;
        } else {
            return $this->attributes['isMain'] = 0;
        }


    }

    public function getDatePublishAttribute()
    {
        return $this->attributes['datePublish'] = date('d/m/Y', strtotime($this->created_at));
    }

    public function scopePublish($q)
    {
        return $q->where('galleries.hidden', 1);
    }

    public function getPublish()
    {
        return $this->publish()->get();
    }

    public function scopeMainPage($q)
    {
        return $q->where('galleries.is_main_page', 1);
    }

    public function getMainPage()
    {
        return $this->mainPage()->get();
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('images')->publish();
    }

    //Получения родителя каталога
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->where('parent_id', null);
    }

    public function images()
    {
        return $this->hasMany(GalleryImg::class, 'id_gallery')->orderBy('position', 'asc');
    }


}
