<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrdersAddressesDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_orders_addresses_delivery', function (Blueprint $table) {
            $table->id();

            $table->string('city', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('house_num', 50)->nullable();
            $table->string('corps', 50)->nullable();
            $table->string('structure', 50)->nullable();
            $table->string('office', 50)->nullable();
            $table->string('zip_code', 50)->nullable();

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
        Schema::dropIfExists('form_orders_addresses_devivery');
    }
}
