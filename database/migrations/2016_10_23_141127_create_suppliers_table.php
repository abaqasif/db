<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('owner_name')->nullable();
            $table->string('owner_number')->nullable();
            $table->string('phone_number');
            $table->string('contact_person');
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->integer('payment_term');
            $table->double('credit_limit',10,2)->default(0);
            $table->string('web_add')->nullable();
       

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
