<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTax extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblclient', function(Blueprint $table){
            $table->renameColumn('tax_id', 'paymentmethod');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblclient', function(Blueprint $table){
            $table->renameColumn('paymentmethod', 'tax_id');
        }); 
    }
}
