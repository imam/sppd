<?php

use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Role;
        $role->name         = 'admin';
        $role->display_name = 'Administrator'; // optional
        $role->save();
        $role = new \App\Role;
        $role->name         = 'supervisor';
        $role->display_name = 'Supervisor'; // optional
        $role->save();
        $role = new \App\Role;
        $role->name         = 'staff';
        $role->display_name = 'Staff'; // optional
        $role->save();
    }
}
