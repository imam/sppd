<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(UMKSeeder::class);
        $this->call(PerjalananDinasSeeder::class);
        $this->call(TransaksiPerjalananDinasSeeder::class);
        $this->call(PembayaranSeeder::class);
    }
}
