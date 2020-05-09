<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_produksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pra_produksi_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_pengeluaran');
            $table->integer('jumlah_pengeluaran');
            $table->string('rincian')->nullable();
            $table->timestamps();

            $table->foreign('pra_produksi_id')->references('id')->on('pra_produksi');
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
        Schema::dropIfExists('pengeluaran_produksi');
    }
}
