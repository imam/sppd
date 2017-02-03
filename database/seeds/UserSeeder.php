<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name'=>'Imam Assidiqqi',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin'),
            'tahun_anggaran' => '2017',
        ]);
        $user->attachRole(\App\Role::where('name','admin')->first());
        factory(\App\User::class, 10)->create()->each(function($u){
            $role = collect(['admin','supervisor','staff'])->random();
            $u->attachRole(\App\Role::where('name',$role)->first());
        });
    }
}
