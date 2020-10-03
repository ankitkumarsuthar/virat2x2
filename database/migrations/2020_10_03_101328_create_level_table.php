<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level', function (Blueprint $table) {
            $table->id();
            $table->string('level_title', 255)->nullable()->default(null);
            $table->integer('level_payment')->nullable()->default(0);
            $table->string('level_user_count', 255)->nullable()->default(null);
            $table->string('level_gift', 1024)->nullable()->default(null);
            $table->timestamp('level_date')->nullable()->default(null);           
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
        Schema::dropIfExists('level');
    }
}
