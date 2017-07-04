<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityWeekdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_weekdays', function (Blueprint $table) {
            $table->integer('event_id')->nullable()->unsigned()->index();
            $table->integer('weekday_id')->nullable()->unsigned()->index();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('weekday_id')->references('id')->on('weekdays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_weekdays');
    }
}
