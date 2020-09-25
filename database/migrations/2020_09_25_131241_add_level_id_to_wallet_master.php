<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelIdToWalletMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('wallet_master', function (Blueprint $table) {
            $table->integer('level_id')->unsigned()->nullable()->index()->comment('FK FROM level TABLE')->after('user_master_id');
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
            $table->dropColumn('level_id');
        });
    }
}
