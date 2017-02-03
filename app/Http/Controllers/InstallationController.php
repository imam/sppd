<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\TahunAnggaran;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    public function get()
    {
        if(User::first()){
            return redirect('/');
        }
        return view('install');
    }

    public function signup(Request $request)
    {
        if(User::first()){
            return redirect('/');
        }
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'confirm_password' =>'required|same:password',
        ]);
        $user = User::create([
            'name' => 'Admin',
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

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

        $edit_pegawai = new Permission();
        $edit_pegawai->name = 'edit-pegawai';
        $edit_pegawai->save();

        $admin->attachPermissions([$create_data,$edit_data,$impor_data]);

        $user->attachRole(Role::where('name','admin')->first());

        TahunAnggaran::create(['tahun'=> Carbon::now()->year]);

        \Auth::login($user);
        return redirect('/');
    }
}
