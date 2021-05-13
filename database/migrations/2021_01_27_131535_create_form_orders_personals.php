<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrdersPersonals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_orders_personals', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->nullable();
            $table->string('surname', 100)->nullable();
            $table->string('phone', 100);
            $table->string('email', 100);

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
        Schema::dropIfExists('form_orders_personals');
    }
}
