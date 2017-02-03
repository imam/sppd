<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetugasPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petugas_pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pembayaran_id');
            $table->integer('pegawai_id');
            $table->integer('uang');
            $table->integer('transport');
            $table->integer('penginapan');
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
        Schema::dropIfExists('petugas_pembayaran');
    }
}
