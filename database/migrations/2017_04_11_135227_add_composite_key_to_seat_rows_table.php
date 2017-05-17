<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompositeKeyToSeatRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_row', function($table)
        {
            $table->unique(['auditorium_id', 'row_name']);
            $table->index(['auditorium_id', 'row_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_row', function($table)
        {
            $table->dropUnique(['auditorium_id', 'row_name']);
            $table->dropIndex(['auditorium_id', 'row_name']);
        });
    }
}
