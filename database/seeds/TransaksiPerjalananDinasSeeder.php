<?php

use Illuminate\Database\Seeder;

class TransaksiPerjalananDinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\TransaksiPerjalananDinas::class,50)->make()->each(function ($u){
            $faker = new \Faker\Generator;
            $p = factory(\App\PetugasTransaksiPerjalananDinas::class,10)->make();
            $u->ketua_perjalanan_id = $p->random()->pegawai_id;
            $u->save();
            $pej = factory(\App\PejabatTransaksiPerjalananDinas::class,10)->make();
            $u->petugas()->saveMany($p);
            $u->pejabat()->saveMany($pej);
        });
    }
}
