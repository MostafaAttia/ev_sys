<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompositeKeyToScreeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screening', function($table)
        {
            $table->unique(['event_id', 'auditorium_id', 'screening_start']);
            $table->index(['event_id', 'auditorium_id', 'screening_start']);
        });

        Schema::table('seat_reserved', function($table)
        {
            $table->unique(['seat_id', 'screening_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screening', function($table)
        {
            $table->dropUnique(['event_id', 'auditorium_id', 'screening_start']);
            $table->dropIndex(['event_id', 'auditorium_id', 'screening_start']);
        });

        Schema::table('seat_reserved', function($table)
        {
            $table->dropUnique(['seat_id', 'screening_id']);
        });
    }
}
