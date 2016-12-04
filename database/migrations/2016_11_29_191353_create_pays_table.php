<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->date('pdate');
            $table->integer('party_id')->unsigned();
            $table->integer('cheque')->unsigned()->nullable();
            $table->integer('token')->unsigned()->nullable();
            $table->integer('total');
            $table->integer('cash')->nullable();
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
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
        Schema::dropIfExists('pays');
    }
}
