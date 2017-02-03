<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        $supervisor = new Role();
        $supervisor->name = 'supervisor';
        $supervisor->save();

        $staff = new Role();
        $staff->name = 'staff';
        $staff->save();

        $create_data = new \App\Permission();
        $create_data->name = 'create-data';
        $create_data->save();

        $edit_data = new \App\Permission();
        $edit_data->name = 'edit-data';
        $edit_data->save();

        $impor_data = new \App\Permission();
        $impor_data->name = 'impor-data';
        $impor_data->save();

        $admin->attachPermissions([$create_data,$edit_data,$impor_data]);
    }
}
