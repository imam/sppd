<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kegiatan_id');
            $table->integer('pejabat_pelaksana_teknis_kegiatan_pegawai_id');
            $table->integer('pejabat_pengadaan_barang_dan_jasa_pegawai_id');
            $table->integer('pejabat_kuasa_pengguna_anggaran_pegawai_id');
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
        Schema::dropIfExists('umk');
    }
}
