<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWastagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rm_code');
            $table->foreign('rm_code')->references('rm_code')->on('raw_materials');
            $table->date('date');
            $table->float('qty');
            $table->integer('cost');
            $table->string('remarks');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wastages');

    }
}
