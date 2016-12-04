<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supp_id')->unsigned();
            $table->integer('purchase_receipt_id')->unsigned();
            $table->string('cheque_no');
            $table->string('remarks');
            $table->double('total',30,2);
            $table->date('date');

            $table->foreign('purchase_receipt_id')->references('id')->on('purchase_receipt');
            $table->foreign('supp_id')->references('id')->on('suppliers');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
        
    }
}
