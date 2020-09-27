<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->string('title', 255)->nullable()->default(null);
            $table->string('details', 1500)->nullable()->default(null);
            $table->date('insert_date')->nullable()->default(null);
            $table->smallInteger('status')->default(0)->comment('0-do not show,1-show, 2-pending');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification');
    }
}
