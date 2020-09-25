<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeFkInLevelIdFieldIntoWalletMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_master', function (Blueprint $table) {
            $table->foreign('level_id')->references('id')->on('level')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
            $table->dropForeign('wallet_master_level_id_foreign');
        });
    }
}
