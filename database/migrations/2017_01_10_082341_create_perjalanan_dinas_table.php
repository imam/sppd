<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun_anggaran');
            $table->integer('kegiatan_id');
            $table->integer('sub_kegiatan_id');
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('referensi_perjalanan');
            $table->string('nomor_referensi');
            $table->date('tanggal_referensi');
            $table->string('jenis_perjalanan');
            $table->string('tingkat_biaya_perjalanan_dinas');
            $table->string('maksud_perjalanan');
            $table->string('alat_angkutan_yang_digunakan');
            $table->string('keterangan_lain_lain');
            $table->string('pejabat_pelaksana_teknis_kegiatan');
            $table->string('pejabat_pengadaan_barang_dan_jasa');
            $table->string('pejabat_kuasa_pengguna_anggaran');
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
        Schema::dropIfExists('perjalanan_dinas');
    }
}
