<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('request_accept_by_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('user_master_id')->unsigned()->nullable()->index()->comment('FK FROM user_master TABLE');
            $table->string('withdraw_amount', 25)->nullable()->default(null);
            $table->string('withdraw_detail', 1500)->nullable()->default(null);
            $table->date('withdraw_request_date')->nullable()->default(null);
            $table->date('withdraw_done_date')->nullable()->default(null);
            $table->smallInteger('withdraw_status')->default(0)->comment('0-pending,1-done, 2-reject');            
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
        Schema::dropIfExists('withdraw_requests');
    }
}
