<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Collection;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Session;

/**
 * App\Models\Admin\Catalog
 *
 * @property int $id
 * @property string $meta_tag_title
 * @property string|null $meta_tag_keywords
 * @property string|null $meta_tag_description
 * @property string $name
 * @property string|null $anons
 * @property string $description
 * @property string $url
 * @property int $parent_id
 * @property int $per_page
 * @property int|null $position
 * @property int|null $sort
 * @property int|null $sort_order
 * @property string|null $img
 * @property string $author
 * @property string $update_author
 * @property int $hidden
 * @property int $index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereAnons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog wherePerPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUpdateAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUrl($value)
 * @mixin \Eloquent
 */
class Catalog extends Model
{

    //EVENTS ELOQUENT MODEL
    public static function boot()
    {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function (Catalog $catalog) {
            if (!empty($catalog->img)) {
                Storage::delete($catalog->img);
            }
            $products = $catalog->products()->get();
            if (!empty($products)) {
                foreach ($products as $index => $product) {
                    $isDelete = Product::find($product->id)->delete();
                }
            }

        });
    }

    use NodeTrait;

    protected $table = 'catalogs';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'name',
        'anons',
        'description',
        'url',
        'position',
        'sort',
        'sort_order',
        'img',
        'hidden',
        'index',
        'parent_id'
    ];
    protected $guarded = ['lft', 'rgt', 'parent_id'];


    public function scopeIndex($q)
    {
        return $q->where('catalogs.index', 1);
    }

    public function getIndex()
    {
        return $this->index()->get();
    }

    public function getAllChildren ()
    {
        $sections = new Collection();

        foreach ($this->children as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }

        return $sections;
    }
    public function getAllChildrenIds ()
    {
        $sections = new \Illuminate\Support\Collection();
        foreach ($this->children as $section) {
            $sections->push($section->id);
            $sections = $sections->merge($section->getAllChildrenIds());
        }
        return $sections;
    }


    public function scopePublish($q)
    {
        return $q->where('catalogs.hidden', 1);
    }

    public function getPublish()
    {
        return $this->publish()->get();
    }

    public function catalog()
    {
        return $this->hasMany(Catalog::class);
    }

    /**
     * @param object $catalog
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */

    public function getProductsInCatalog($catalog, $perPage = 50)
    {
        $paginator = $catalog->products()->with('firstImage')->publish()->orderBy('position', 'asc')->paginate($perPage);

//Обрабатываем все элементы массива
        $items = $paginator->getCollection()->transform(function ($product, $key) {

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

    //Получение всех дочерних каталогов
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

//Получения родителя каталога
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

//Получение всех продуктов из каталога
    public function products()
    {
        return $this->hasMany(Product::class, 'id_catalog');
    }

}
