<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Permintaan Cabai
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pemasok_id');
            $table->string('jenis_cabai');
            $table->integer('jumlah_cabai');
            $table->integer('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal_diterima');
            $table->date('tanggal_pengiriman')->nullable();
            $table->integer('status_permintaan');
            $table->integer('status_pengiriman')->nullable();
            $table->integer('status_pemesanan')->nullable();
            $table->timestamps();
            
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
