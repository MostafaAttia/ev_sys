<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('row_spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('row_id')->index();
            $table->integer('starts_at');
            $table->integer('ends_at');

             $table->foreign('row_id')->references('id')->on('seat_row')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('row_spaces');
    }
}
