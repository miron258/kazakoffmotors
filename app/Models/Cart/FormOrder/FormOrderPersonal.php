<?php

namespace App\Models\Cart\FormOrder;

use Illuminate\Database\Eloquent\Model;

class FormOrderPersonal extends Model
{
    protected $table = 'form_orders_personals';




    public function formOrder()
    {
        return $this->belongsTo(FormOrder::class, 'id_order');
    }
}
