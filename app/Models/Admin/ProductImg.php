<?php

namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImg extends Model
{
//    use HasFactory;
    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function(ProductImg $productImg) {
            if (!empty($productImg->name)) {
                Storage::delete("products/".$productImg->name);
                Storage::delete("products/thumbs/".$productImg->name);
            }
        });
    }

    protected $guarded = [
        'id'
    ];
    protected $fillable = ['name', 'hidden', 'alt', 'id_product'];

    public function scopePublish($q) {
        return $q->where('hidden', 1);
    }
    public function getPublish()
    {
        return $this->publish()->get();
    }
    ///Получить продукт к которому относятся изображения
    public function product() {
        //belonsTo указывает на родителя тоесть кому принадлжит изображение
        return $this->belongsTo(Product::class, 'id');
    }


    //Получить каталог к которому относится изображение
//    public function catalog(){
//        return $this->bel
//    }


}
