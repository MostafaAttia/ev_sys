<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsNoToAuditoriumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditorium', function($table)
        {
            $table->integer('columns_no');
            $table->integer('rows_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditorium', function($table)
        {
            $table->dropColumn('columns_no');
            $table->dropColumn('rows_no');
        });
    }
}
