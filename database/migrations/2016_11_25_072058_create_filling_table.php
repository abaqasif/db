<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('fillings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('packing_id')->unsigned();
            $table->integer('qty');
            $table->float('weight');
            $table->string('unit');
            $table->integer('batch_id')->unsigned();
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
        Schema::drop('fillings');
    }
}
