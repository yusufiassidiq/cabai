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
            $table->unsignedBigInteger('user1_id');
            $table->unsignedBigInteger('user2_id');
            $table->integer('status');
            $table->unsignedBigInteger('action_user');
            $table->integer('flag')->default(0); //check id terbesar
            $table->timestamps();

            $table->foreign('user1_id')->references('id')->on('users');

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
