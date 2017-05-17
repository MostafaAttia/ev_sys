<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrganiserIdToAuditoriumsTable extends Migration
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
            $table->integer('organiser_id')->unsigned()->index();
            $table->boolean('is_public')->default(false);



            $table->foreign('organiser_id')->references('id')->on('organisers')->onDelete('cascade');
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
            $table->dropColumn('organiser_id');
            $table->dropColumn('is_public');
        });
    }
}
