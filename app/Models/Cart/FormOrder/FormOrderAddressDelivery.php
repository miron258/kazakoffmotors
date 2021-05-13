<?php

namespace App\Models\Cart\FormOrder;

use Illuminate\Database\Eloquent\Model;

class FormOrderAddressDelivery extends Model
{
    protected $table = 'form_orders_addresses_delivery';

    public function formOrder()
    {
        return $this->belongsTo(FormOrder::class, 'id_order');
    }

}
