<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('purchase_return', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_receipt_id')->unsigned();
            $table->integer('qty');
            $table->double('rate',11,2);
            $table->double('tax_rate',3,2);
            $table->double('tax_amount',30,2);
            $table->double('total',30,2);
            $table->date('rdate');

            $table->foreign('purchase_receipt_id')->references('id')->on('purchase_receipt');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_return');
        //
    }
}
