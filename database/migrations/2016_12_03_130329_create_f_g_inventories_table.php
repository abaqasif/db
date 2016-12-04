<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFGInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fg_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factory');
            $table->integer('warehouse');
            $table->integer('open_bal');
            $table->integer('price');
            $table->integer('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks')->ondelete('cascade');
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->integer('inv_id')->unsigned();
            $table->foreign('inv_id')->references('id')->on('fg_inventories')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_g_inventories');
    }
}
