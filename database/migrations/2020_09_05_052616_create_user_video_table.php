<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_video', function (Blueprint $table) {
            $table->increments('id');         
            $table->integer('user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('video_id')->unsigned()->nullable()->index()->comment('FK FROM video_master TABLE');
            $table->smallInteger('complete_watch')->default(0)->comment('0-no,1-yes');
            $table->smallInteger('is_watched')->default(0)->comment('0-no,1-yes');
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_video');
    }
}
