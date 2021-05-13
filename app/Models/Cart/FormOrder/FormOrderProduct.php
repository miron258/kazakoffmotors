<?php

namespace App\Models\Cart\FormOrder;

use Illuminate\Database\Eloquent\Model;

class FormOrderProduct extends Model
{
    protected $table = 'form_orders_products';
    protected $appends = array('options', 'productModel');

    public function getOptionsAttribute()
    {
        return $this->attributes['options'] = json_decode($this->attributes['attributes'], true);
    }

    public function getProductModelAttribute()
    {
        return  $this->attributes['productModel'] =  json_decode($this->associated_model, true);
    }

    public function formOrder()
    {
        return $this->belongsTo(FormOrder::class, 'id_order');
    }
}
