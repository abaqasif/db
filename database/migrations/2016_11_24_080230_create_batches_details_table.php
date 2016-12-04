<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('batch_details', function (Blueprint $table) {
            $table->increments('id');
            $table->float('additional')->nullable();
            $table->float('qty')->nullable();
            $table->float('amount');
            $table->integer('batch_id')->unsigned();
            $table->foreign('batch_id')->references('id')->on('batches')->ondelete('cascade');
            $table->string('rm_code');
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
        Schema::drop('batch_details');
    }
}
