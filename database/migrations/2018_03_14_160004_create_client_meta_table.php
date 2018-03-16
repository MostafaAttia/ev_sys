<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->index();
            $table->tinyInteger('show_email')->default(1);
            $table->tinyInteger('show_gender')->default(1);
            $table->tinyInteger('show_phone')->default(0);
            $table->tinyInteger('show_address')->default(0);
            $table->tinyInteger('show_followings')->default(1);
            $table->tinyInteger('show_favorites')->default(1);
            $table->tinyInteger('show_likes')->default(1);
            $table->tinyInteger('show_attended_events')->default(1);
            $table->tinyInteger('get_notif_about_followings')->default(1);
            $table->tinyInteger('get_notif_about_favorites')->default(1);
            $table->tinyInteger('get_mail_notif')->default(0);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_meta');
    }
}
