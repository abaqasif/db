<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('batch_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qty');
            $table->date('date');
           $table->integer('batch_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches')->ondelete('cascade');
            $table->integer('test_id')->unsigned();
            $table->foreign('test_id')->references('id')->on('tests')->ondelete('cascade');
        });
        Schema::table('fillings', function (Blueprint $table) {
            $table->foreign('packing_id')->references('id')->on('packings')->ondelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('batch_test');
    }
}
