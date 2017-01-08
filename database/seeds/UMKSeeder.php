<?php

use Illuminate\Database\Seeder;

class UMKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\UMK::class,50)->create()->each(function($u){
            factory(\App\RekeningPengajuan::class,10)->make()->each(function ($rp) use ($u){
                $sub_kegiatan = $u->kegiatan->sub_kegiatan()->inRandomOrder()->first();
                $rp->sub_kegiatan_id = $sub_kegiatan->id;
                $u->rekening_pengajuan()->save($rp);
            });
        });
    }
}
