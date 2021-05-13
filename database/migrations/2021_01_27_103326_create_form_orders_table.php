<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('delivery_method'); //Способ доставки
            $table->tinyInteger('payment_method'); //Способ оплаты
            $table->text('text_order')->nullable(); //Комментарий текст к заказу
            $table->tinyInteger('discount_order')->nullable(); //Скидка к заказу если была приминена
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_orders');
    }
}
