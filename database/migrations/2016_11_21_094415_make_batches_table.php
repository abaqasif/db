<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique();
            $table->integer('gross_weight');
            $table->integer('empty_weight');
            $table->integer('order_no');
            $table->float('total_amount');
            $table->float('total_material');
            $table->float('cost_per_unit');
            $table->integer('batch_size');
            $table->integer('recipe_id')->unsigned();
            $table->boolean('received_paper')->default(false);
            $table->boolean('received_card')->default(false);
            $table->boolean('hold')->default(false);
            $table->boolean('cancelled')->default(false);
            $table->boolean('filling_lock')->default(false);
          $table->date('filling_date')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::drop('batches');
    }
}
