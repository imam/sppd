<?php

use Illuminate\Database\Seeder;

class PerjalananDinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\PerjalananDinas::class, 50)->create();
    }
}
