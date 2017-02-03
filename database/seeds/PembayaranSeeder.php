<?php

use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Pembayaran::class, 50)->create()->each(function($p){
            $pet = factory(\App\PetugasPembayaran::class, 10)->make();
            $p->petugas_pembayaran()->saveMany($pet);
        });
    }
}
