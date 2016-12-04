<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodsReturnLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_return_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_return_id')->unsigned();
            $table->integer('stock_id')->unsigned();
            $table->integer('quantity');
            $table->integer('discount');
            $table->foreign('goods_return_id')->references('id')->on('goods_returns')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
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
        Schema::dropIfExists('goods_return_stock');
    }
}
