<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActivityColumnToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function($table)
        {
            $table->tinyInteger('is_activity')->nullable()->default(0);
            $table->date('activity_start_date')->nullable();
            $table->date('activity_end_date')->nullable();
            $table->time('activity_start_time')->nullable();
            $table->time('activity_end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function($table)
        {
            $table->dropColumn('is_activity');
            $table->dropColumn('activity_start_date');
            $table->dropColumn('activity_end_date');
            $table->dropColumn('activity_start_time');
            $table->dropColumn('activity_end_time');
        });
    }
}
