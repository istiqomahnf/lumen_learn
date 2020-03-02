<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblinvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblinvoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->string('status');
            $table->string('paymentmethod');
            $table->boolean('draft')->default(0);
            $table->boolean('sendinvoice')->default(0);
            $table->date('date');
            $table->date('duedate');
            $table->float('taxrate');
            $table->float('itemamount');
            $table->boolean('itemtaxed')->default(0);
            $table->string('itemdescription');
            $table->boolean('autoapplycredit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblinvoice');
    }
}
