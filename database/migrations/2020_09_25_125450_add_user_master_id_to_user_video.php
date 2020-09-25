<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserMasterIdToUserVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('user_video', function (Blueprint $table) {
            $table->integer('user_master_id')->unsigned()->nullable()->index()->comment('FK FROM user_master TABLE')->after('user_id');
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
            $table->dropColumn('user_master_id');
        });
    }
}
