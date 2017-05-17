<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatReservedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_reserved', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seat_id')->index();
            $table->unsignedInteger('screening_id')->index();
            $table->unsignedInteger('attendee_id')->index();
            $table->timestamps();

            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->foreign('screening_id')->references('id')->on('screening')->onDelete('cascade');
            $table->foreign('attendee_id')->references('id')->on('attendees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seat_reserved');
    }
}
