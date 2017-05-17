<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToAuditoriumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auditorium', function ($table) {
            $table->softDeletes();
        });

        Schema::table('screening', function ($table) {
            $table->softDeletes();
        });

        Schema::table('seats', function ($table) {
            $table->softDeletes();
        });

        Schema::table('seat_row', function ($table) {
            $table->softDeletes();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auditorium', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('screening', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('seats', function ($table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('seat_row', function ($table) {
            $table->dropColumn('deleted_at');
        });


    }
}
