<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('purchase_receipt', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_orders_id')->unsigned();
            $table->integer('purchase_orders_details_id')->unsigned();
            $table->integer('p_qty')->default(0);
            $table->double('rate',11,2);
            $table->double('tax_rate',3,2);
            $table->double('tax_amount',30,2);
            $table->double('total',30,2);
            $table->date('pdate');
              $table->foreign('purchase_orders_id')->references('id')->on('purchase_orders');
            $table->foreign('purchase_orders_details_id')->references('id')->on('purchase_order_lines');

    });
      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_receipt');
    }
}
