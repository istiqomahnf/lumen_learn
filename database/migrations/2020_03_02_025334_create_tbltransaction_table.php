<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbltransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbltransaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transactionid')->nullable();
            $table->integer('clientid');
            $table->integer('invoiceid')->nullable();
            $table->float('amountin')->default(0);
            $table->float('amountout')->default(0);
            $table->string('paymentmethod')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('tbltransaction');
    }
}
