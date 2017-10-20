<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailUtility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_utilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utility_sub_name');
            $table->integer('utility_master_id')->unsigned()->nullable();
            $table->foreign('utility_master_id')->references('id')->on('master_utilities');
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
        Schema::dropIfExists('detail_utility');
    }
}
