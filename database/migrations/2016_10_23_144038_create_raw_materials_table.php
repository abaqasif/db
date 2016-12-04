<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('raw_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('rm_code')->unique();
            $table->string('type')->default('not defined');
            $table->string('uom');
            $table->integer('op_inv')->default(0);
            $table->integer('pack_size')->default(0);
            $table->integer('qty_available')->default(0);
            $table->integer('supp_id')->unsigned();
            $table->double('rate',11,2);
            $table->foreign('supp_id')->references('id')->on('suppliers')->ondelete('cascade');



           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('raw_materials');
    }
}
