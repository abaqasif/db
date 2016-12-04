<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('purchase_order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_orders_id')->unsigned();
            $table->integer('rm_id')->unsigned();
            $table->integer('qty');
            $table->double('rate',11,2);
            $table->double('tax_rate',3,2);
            $table->double('tax_amount',30,2);
            $table->double('total',30,2);

            $table->foreign('purchase_orders_id')->references('id')->on('purchase_orders');
            $table->foreign('rm_id')->references('id')->on('raw_materials');



    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_order_lines');
    }
}
