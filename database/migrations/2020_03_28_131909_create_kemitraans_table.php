<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemitraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemitraan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('status');
            $table->unsignedBigInteger('action_user');
            
            $table->unsignedBigInteger('user1_id');
            $table->foreign('user1_id')->references('id')->on('users');

            $table->unsignedBigInteger('user2_id');
            $table->foreign('user2_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemitraan');
    }
}
