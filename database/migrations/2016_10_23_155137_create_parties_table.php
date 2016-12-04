<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('salesmen_id')->unsigned();
            $table->string('area');
            $table->string('address');
            $table->string('fax')->nullable();
            $table->string('mobile');
            $table->integer('balance');
            $table->integer('open_balance');
            $table->integer('credit_limit');
            $table->string('day');
            $table->foreign('salesmen_id')->references('id')->on('salesmens')->onDelete('cascade');
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
        Schema::dropIfExists('parties');
    }
}
