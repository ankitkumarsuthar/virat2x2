<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeFkInUserMasterIdFieldIntoUserVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_video', function (Blueprint $table) {
            $table->foreign('user_master_id')->references('id')->on('user_master')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_video', function (Blueprint $table) {
            $table->dropForeign('user_video_user_master_id_foreign');
        });
    }
}
