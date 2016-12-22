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
        factory(Program::class,10)->create()->each(function($program){
            /** @var $program Program */
            /** @var $kegiatan Kegiatan*/
            /** @var $sub_kegiatan Sub_Kegiatan */
            factory(Kegiatan::class, 10)->make()->each(function($kegiatan)use($program){
                $program->kegiatan()->save($kegiatan);
                factory(Sub_Kegiatan::class,10)->make()->each(function($sub_kegiatan) use($kegiatan){
                    /** @var $kegiatan Kegiatan */
                    /** @var $sub_kegiatan Sub_Kegiatan */
                    $kegiatan->sub_kegiatan()->save($sub_kegiatan);
                    $sub_kegiatan->save();
                    $sub_kegiatan->uraian()->save(factory(Uraian_Sub_Kegiatan::class)->make());
                });
            });


        });
    }
}
