<?php

use App\Dppa\Kegiatan;
use App\DPPA\Program;
use App\Dppa\Sub_Kegiatan;
use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dppa = new \App\Http\Controllers\DPPAController;
        $dppa->import_file('file/00001_DPA_v3.xlsx',2016);
        $pegawai = new \App\Http\Controllers\PegawaiController();
        $pegawai->import_file('file/00001_PEGAWAI_2015.xlsx');
    }
}
