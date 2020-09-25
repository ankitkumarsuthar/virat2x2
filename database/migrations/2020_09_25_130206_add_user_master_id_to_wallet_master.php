<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserMasterIdToWalletMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_master', function (Blueprint $table) {
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
        Schema::table('wallet_master', function (Blueprint $table) {
            $table->dropColumn('user_master_id');
        });
    }
}
