<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_master', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('create_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('update_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('transfer_to_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('paid_to_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('referal_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');

            $table->integer('sending_money_user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('receiving_money_user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            
            $table->string('payment_mobile', 25)->nullable()->default(null);
            $table->string('pay_amount', 25)->nullable()->default(null);

            $table->string('payment_detail', 1024)->nullable()->default(null);

            $table->smallInteger('is_earning_money')->default(0)->comment('0-no,1-yes');
            $table->smallInteger('sending_or_receiving')->default(0)->comment('0-sending,1-receiving');
            $table->smallInteger('is_transfer_money')->default(0)->comment('0-no,1-yes');
            $table->smallInteger('is_it_reference_bonous')->default(0)->comment('0-no,1-yes');

            $table->smallInteger('payment_status')->default(0)->comment('1-referal, 2-video earning, 3-transfer');
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
