<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDppaSubKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dppa_sub_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->bigInteger('jumlah_anggaran');
            $table->integer('kegiatan_id');
            $table->integer('uraian_id');
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
        Schema::dropIfExists('dppa_sub_kegiatan');
    }
}
