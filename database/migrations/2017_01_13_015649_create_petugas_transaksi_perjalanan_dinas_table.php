<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetugasTransaksiPerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petugas_transaksi_perjalanan_dinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_surat');
            $table->integer('transaksi_perjalanan_dinas_id');
            $table->string('pegawai_id');
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
        Schema::dropIfExists('petugas_transaksi_perjalanan_dinas');
    }
}
