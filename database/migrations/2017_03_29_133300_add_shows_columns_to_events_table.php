<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowsColumnsToEventsTable extends Migration
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
            $table->boolean('is_show')->default(false);
            $table->string('director')->nullable();
            $table->text('cast')->nullable();
            $table->integer('duration')->nullable();
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
            $table->dropColumn('is_show');
            $table->dropColumn('director');
            $table->dropColumn('cast');
            $table->dropColumn('duration');
        });
    }
}
