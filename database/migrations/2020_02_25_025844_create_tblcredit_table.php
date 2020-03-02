<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcredit', function (Blueprint $table) {
            $table->bigIncrements('creditid');
            $table->integer('userid');
            $table->integer('invoiceid');
            $table->float('add_credit');
            $table->float('removed_credit')->default(0.00); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblcredit');
    }
}
