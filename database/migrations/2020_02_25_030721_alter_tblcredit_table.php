<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTblcreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblcredit', function(Blueprint $table){
            $table->renameColumn('add_credit', 'amount');
            $table->string('removed_credit')->change();
            $table->renameColumn('removed_credit', 'type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->renameColumn('amount', 'add_credit');
        $table->renameColumn('type', 'removed_credit');
    }
}
