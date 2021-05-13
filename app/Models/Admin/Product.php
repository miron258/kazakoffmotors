<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Storage;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;
use TeamTNT\TNTSearch\TNTSearch;
use Illuminate\Http\Request;
use TeamTNT\TNTSearch\Support\Highlighter;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Admin\Product
 *
 * @property int $id
 * @property string $meta_tag_title
 * @property string|null $meta_tag_keywords
 * @property string|null $meta_tag_description
 * @property string|null $art
 * @property string $name
 * @property string|null $anons
 * @property string $description
 * @property string $url
 * @property int $id_catalog
 * @property int $price
 * @property int|null $old_price
 * @property string|null $img
 * @property string|null $properties
 * @property int|null $count_stock
 * @property string|null $video
 * @property string $author
 * @property string $update_author
 * @property int $sale
 * @property int $new
 * @property int $popular
 * @property int $availability
 * @property int $hidden
 * @property int $index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAnons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCountStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIdCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdateAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVideo($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Notifiable;

    //EVENTS ELOQUENT MODEL
    public static function boot()
    {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function (Product $product) {
            $oldImages = $product->images()->get();
            if (!empty($oldImages)) {
                foreach ($oldImages as $index => $img) {
                    $isDelete = ProductImg::find($img->id)->delete();
                }
            }
        });
    }

    use Searchable;

    protected $fillable = [
        'id', 'name', 'description', 'url'
    ];
    public $asYouType = false;

    //Make it available in the json response
    //Новые добавляемые поля в выбору ТОЛЬКО ЭТО СВОЙСТВО ДОБАВЛЯЕТ ПОЛЯ В ОБЩУЮ ВЫБОРКУ
    protected $appends = array('isCart', 'classButton', 'fullName', 'fullUrl', 'pathImgThumbnail', 'loaderProduct');
    //Add extra attribute
//    protected $attributes = array('is_cart', 'class_button', 'full_name', 'full_url', 'path_img_thumbnail');
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
//        $array = $this->toArray();

//        dd($array);
        $array = [
            'name' => '',
//            'pathImgThumbnail' => '',
            'art' => ''
        ];

        // Customize array...

        return $array;
    }

    public function scopeIndex($q)
    {
        return $q->where('products.index', 1);
    }

    public function getIndex()
    {
        return $this->index()->get();
    }

    public function scopePublish($q)
    {
        return $q->where('products.hidden', 1);
    }

    public function getPublish()
    {
        return $this->publish()->get();
    }

    public function scopeSale($q)
    {
        return $q->where('products.sale', 1);
    }

    public function getSale()
    {
        return $this->sale()->get();
    }

    public function scopeNew($q)
    {
        return $q->where('products.new', 1);
    }

    public function getNew()
    {
        return $this->new()->get();
    }

    public function scopePopular($q)
    {
        return $q->where('products.popular', 1);
    }

    public function getPopular()
    {
        return $this->popular()->get();
    }

    public function searchProducts($query, $isPagination = true, $perPage = 4)
    {
        $tnt = new TNTSearch;
        if ($isPagination) {
            $paginator = Product::search($query)->paginate($perPage);
            //Products Collection Filter Transform
            $items = $paginator->getCollection()->transform(function ($product) use ($query, $tnt) {
                $product->name = $tnt->highlight($product->name, $query, 'b', [
                    'simple' => false,
                    'wholeWord' => false,
                    'tagOptions' => [
                        'class' => 'search-term',
                        'title' => $query
                    ]
                ]);
                $product->art = $tnt->highlight($product->art, $query, 'b', [
                    'simple' => false,
                    'wholeWord' => false,
                    'tagOptions' => [
                        'class' => 'search-term',
                        'title' => $query
                    ]
                ]);

                return $product;
            });
        } else {
            $paginator = Product::search($query)->get();
            //Products Collection Filter Transform
            $items = $paginator->transform(function ($product) use ($query, $tnt) {
                $product->name = $tnt->highlight($product->name, $query, 'b', [
                    'simple' => false,
                    'wholeWord' => false,
                    'tagOptions' => [
                        'class' => 'search-term',
                        'title' => $query
                    ]
                ]);
                $product->art = $tnt->highlight($product->art, $query, 'b', [
                    'simple' => false,
                    'wholeWord' => false,
                    'tagOptions' => [
                        'class' => 'search-term',
                        'title' => $query
                    ]
                ]);

                return $product;
            });


        }


        if ($isPagination) {
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $paginator->total(),
                $paginator->perPage(),
                $paginator->currentPage(), [
                    'path' => \Request::url(),
                    'query' => [
                        'query' => $query,
                        'page' => $paginator->currentPage()
                    ]
                ]
            );
            return $products;
        } else {
            return $items;
        }

    }

    public function getIsCartAttribute()
    {
        $isCart = (!empty(\Cart::session(Session::getId())->get($this->id))) ? true : false;
        return $this->attributes['isCart'] = $isCart;
    }

    public function getPathImgThumbnailAttribute()
    {

        if (isset($this->firstImage->name)) {
            return $this->attributes['pathImgThumbnail'] = Storage::url('products/thumbs/' . $this->firstImage->name);
        } else {
            return '';
        }

    }

    public function getFullUrlAttribute()
    {
        if (!is_null($this->url)) {
            return $this->attributes['fullUrl'] = route('product_site.index', $this->url);
        } else {
            return '';
        }

    }

    public function getClassButtonAttribute()
    {
        return $this->attributes['classButton'] = (!empty(\Cart::session(Session::getId())->get($this->id))) ? 'in-cart' : 'not-in-cart';
    }

    public function getLoaderProductAttribute()
    {
        return $this->attributes['loaderProduct'] = false;
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['fullName'] = "{$this->name} {$this->art}";
    }

    public function getAllProducts($perPage = 1500, $idCatalog = '', $price = '', $name = '', $art = '')
    {


        $products = Product::join('catalogs', 'products.id_catalog', '=', 'catalogs.id')
            ->select(array('products.*', 'catalogs.name as name_catalog', 'catalogs.id as idCatalog'));

        if (!is_null($idCatalog) && !empty($idCatalog)) {
            $catalog = Catalog::where('id', $idCatalog)->get()->first();
            $idsChildren = $catalog->getAllChildrenIds();

            if (!empty($idsChildren) && count($idsChildren) > 0) {
                $products->whereIn('id_catalog', $idsChildren);
            } else {
                $products->where('id_catalog', $idCatalog);
            }
        }
        if (!is_null($price) && !empty($price)) {
            $products->where('products.price', 'like', '%' . $price . '%');
        }
        if (!is_null($name) && !empty($name)) {
            $products->where('products.name', 'like', '%' . $name . '%');
        }
        if (!is_null($art) && !empty($art)) {
            $products->where('products.art', 'like', '%' . $art . '%');
        }

        $paginator = $products->orderBy('id', 'asc')->paginate($perPage);


//Обрабатываем все элементы массива
        $items = $paginator->getCollection()->transform(function ($product, $key) {
            if (!empty($product->img)) {
                $product->img = json_decode($product->img)[0];
            }
            return $product;
        })->toArray();

        return $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $paginator->currentPage()
                ]
            ]
        );
    }

    /**
     *
     * @param integer $id
     * @return object $product
     */
    public function getProduct($id)
    {
        return $products = DB::table('products')
            ->join('catalogs', 'products.id_catalog', '=', 'catalogs.id')
            ->select('products.*', 'catalogs.name, catalogs.id')
            ->where("products.id", '=', $id)
            ->get()
            ->limit(1);
    }

    /**
     * Получить информацию о категории материала
     */
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id_catalog');
    }


    ///Получить все изображения продукта
    public function images()
    {
        //Связь HasOne значит связь с одним изображением HasMany связь с несколькими изображениями
        //Тоесть означает что к товару привязаны несколько изображений в другой таблице с каскадной связью по ID
        return $this->hasMany(ProductImg::class, 'id_product');
    }

    public function firstImage()
    {
        return $this->hasOne(ProductImg::class, 'id_product');
    }

}
