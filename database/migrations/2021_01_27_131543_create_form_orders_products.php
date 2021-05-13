<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_orders_products', function (Blueprint $table) {
            $table->id();

            $table->integer('id_product');
            $table->integer('qty');
            $table->integer('price'); //Цена товара
            $table->string('name');
            $table->integer('total_price')->nullable(); //Цена товара в сумме с выбранным количеством
            $table->text('attributes')->nullable(); //Все свойства товара Вставляется в виде JSON


            //Set Foreign Key
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')
                ->references('id')
                ->on('form_orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('form_orders_products');
    }
}
