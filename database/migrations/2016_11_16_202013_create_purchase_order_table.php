<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supp_id')->unsigned();
            $table->string('remarks')->default('no remarks');
            $table->double('total',30,2);
           // $table->integer('bill_id');
            $table->date('date');

            $table->foreign('supp_id')->references('id')->on('suppliers');
           // $table->foreign('bill_id')->references('id')->on('bills') ;


    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('purchase_orders');
    }
}
