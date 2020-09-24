<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlmUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('create_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->integer('update_by')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');            
            $table->integer('sponsor_id')->unsigned()->nullable()->index()->comment('FK FROM users TABLE');
            $table->string('name', 255)->nullable()->default(null);
            $table->string('email', 50)->nullable()->default(null);
            $table->string('mobile', 25)->nullable()->default(null);
            $table->string('parent_level', 255)->nullable()->default(null);
            $table->string('current_level', 255)->nullable()->default(null);
            $table->string('sponsor_email', 50)->nullable()->default(null);
            $table->string('address', 1024)->nullable()->default(null);            
            $table->smallInteger('account_status')->default(1)->comment('0-not active,1-active');
            $table->smallInteger('has_sponsor')->default(0)->comment('0-not, 1-yes');

            $table->string('bank_beneficiary_name', 255)->nullable()->default(null);
            $table->string('account_mumber', 255)->nullable()->default(null);
            $table->string('ifsc_code', 255)->nullable()->default(null);
            $table->string('upi_id', 255)->nullable()->default(null);
            $table->string('paytm_phone', 255)->nullable()->default(null);
            


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
        Schema::drop('user_master');
    }
}
