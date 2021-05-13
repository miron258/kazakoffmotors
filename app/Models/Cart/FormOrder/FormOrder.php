<?php

namespace App\Models\Cart\FormOrder;

use Illuminate\Database\Eloquent\Model;
use MenaraSolutions\Geographer;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use Illuminate\Notifications\Notifiable;

class FormOrder extends Model
{
    use Notifiable;

    protected $table = 'form_orders';
    protected $fillable = [
        'num_order',
        'delivery_method',
        'payment_method'
    ];
    protected $appends = array('sumOrder', 'dateOrder', 'city', 'email', 'totalAmount');


    public function getCityAttribute()
    {
        if (isset($this->delivery)) {

            if (!empty($this->delivery->city)) {

                $earth = new Earth();
                $russia = $earth->getCountries()->findOne(['code' => 'RU']);
                $cities = $russia->getStates()->setLocale('ru')->sortBy('name');
                $city = $cities->find(['code' => $this->delivery->city])->pluck('name')[0];
                return $city;

            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    public function getDateOrderAttribute()
    {
        return date('F j, Y h:i:s', strtotime($this->created_at));
    }
    public function getSumOrderAttribute()
    {
        if (isset($this->products)) {
            return $this->attributes['sumOrder'] = $this->products->sum('total_price');
        } else {
            return '';
        }
    }
    public function getTotalAmountAttribute()
    {
        if (isset($this->products)) {

            /// Если доставка курьером добавляем стоимость доставки
            if ($this->delivery_method == 2) {
                return $this->attributes['totalAmount'] = (int) $this->products->sum('total_price') + 500;
            } else {
                return $this->attributes['totalAmount'] = $this->products->sum('total_price');
            }

        } else {
            return '';
        }
    }

    public function getEmailAttribute()
    {
        if (isset($this->personal)) {
            return $this->attributes['email'] = $this->personal->email;
        } else {
            return '';
        }
    }

    public function personal()
    {
        return $this->hasOne(FormOrderPersonal::class, 'id_order');
    }

    public function delivery()
    {
        return $this->hasOne(FormOrderAddressDelivery::class, 'id_order');
    }

    public function products()
    {
        //Связь HasOne значит связь с одним изображением HasMany связь с несколькими изображениями
        //Тоесть означает что к товару привязаны несколько изображений в другой таблице с каскадной связью по ID
        return $this->hasMany(FormOrderProduct::class, 'id_order');
    }

}
