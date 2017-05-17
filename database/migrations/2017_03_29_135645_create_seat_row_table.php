<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatRowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_row', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('auditorium_id')->index();
            $table->char('row_name')->index();
            $table->integer('row_seats_no');
            $table->integer('seat_price');
            $table->timestamps();

            $table->foreign('auditorium_id')->references('id')->on('auditorium')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seat_row');
    }
}
