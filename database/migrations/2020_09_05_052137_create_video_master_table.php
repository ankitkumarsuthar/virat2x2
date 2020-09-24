<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_master', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('create_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('update_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE'); 
            
            $table->longText('video_link')->nullable()->default(null);
            $table->string('video_title', 255)->nullable()->default(null);            
            $table->string('video_earning_amount', 255)->nullable()->default(null);            
            $table->smallInteger('video_status')->default(1)->comment('0-not active,1-active');
            $table->string('video_detail', 1024)->nullable()->default(null);           

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
        Schema::drop('video_master');
    }
}
