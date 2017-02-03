<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_perjalanan_dinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perjalanan_dinas_id');
            $table->string('nomor_surat');
            $table->integer('ketua_perjalanan_id');
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

        Schema::dropIfExists('transaksi_perjalanan_dinas');

    }
}
