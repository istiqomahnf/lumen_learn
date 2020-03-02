<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblitems', function (Blueprint $table) {
            $table->bigIncrements('itemid');
            $table->integer('invoiceid');
            $table->string('itemdescription');
            $table->float('itemamount');
            $table->boolean('itemtaxed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblitems');
    }
}
