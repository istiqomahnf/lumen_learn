<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('clientid');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('comapnyname');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->string('phonenumber');
            $table->string('tax_id');
            $table->string('password');
            $table->string('language');
            $table->string('notes');
            $table->integer('currency');
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
        Schema::dropIfExists('client');
    }
}
