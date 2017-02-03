<?php

namespace App\Http\Controllers;

use App\DPPA\Program;
use App\Pegawai;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();
        \Debugbar::info($data);
        return view('pegawai.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan'=> 'required',
            'status' => 'required',
            'email'=> 'email|unique:users,email',
            'password' => 'required_with:email',
            'role' => 'required_with:email'
        ]);
        $pegawai = Pegawai::create([
            'nama'=>$request->nama,
            'nip'=>$request->nip,
            'jabatan'=>$request->jabatan,
            'status' =>$request->status,
            'pangkat' =>$request->pangkat,
            'npwp' =>$request->npwp
        ]);
        if($request->email){
            $user = User::create([
                'name'=>$request->nama,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);
            $pegawai->user_id = $user->id;
            $pegawai->save();
            $role = Role::where('name',$request->role)->first();
            $pegawai->user->attachRole($role);
        }
        $request->session()->flash('data_created',true);
        return redirect('/pegawai/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $pegawai = Pegawai::with('user.roles')->find($id);
        $old =  $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        \Javascript::put([
            'pegawai' => $pegawai,
            'old' => $old
        ]);
        return view('pegawai.edit',compact(['pegawai']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $validator = \Validator::make($request->all(),[
            'nama' => 'required',
            'jabatan'=> 'required',
            'status' => 'required',
            'email'=> 'email',
            'role' => 'required_with:email'
        ]);
        $validator->sometimes('email','unique:users,email',function($input)use($pegawai){
            if(!$pegawai->user) return true;
            if($pegawai->user->email != $input->email) return true;
            return false;
        });
        $validator->sometimes('password','required_with:email',function($input)use($pegawai){
            if(!$pegawai->user) return true;
            return false;
        });
        if ($validator->fails()) {
            return redirect(route('pegawai.edit',['id'=>$id]))
                ->withErrors($validator)
                ->withInput();
        }
        $pegawai->update([
            'nama'=>$request->nama,
            'nip'=>$request->nip,
            'jabatan'=>$request->jabatan,
            'status' =>$request->status,
            'pangkat' =>$request->pangkat,
            'npwp' =>$request->npwp
        ]);
        $request->session()->flash('data_updated',true);
        $user_update_array = [
            'name'=> $request->nama,
            'email'=>$request->email,
        ];
        if($request->password){
            $user_update_array =  array_merge($user_update_array,['password'=>bcrypt($request->password)]);
        }
        if($request->email){
            if($pegawai->user){
                $pegawai->user->update($user_update_array);
                $pegawai->user->roles()->detach();
            }else{
                $user = User::create($user_update_array);
                $pegawai->user()->associate($user);
                $pegawai->save();
            }
            $role = Role::where('name',$request->role)->first();
            $pegawai->user->attachRole($role);
        }else{
            $pegawai->user()->dissociate();
            $pegawai->save();
        }
        return redirect(route('pegawai.edit',['id'=>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if($pegawai->user){
            $pegawai->user()->delete();
        }
        Pegawai::find($id)->delete();
        return response('Ok',200);
    }

    public function import()
    {
        return view('pegawai.import');
    }

    public function store_import(Request $request)
    {
        $path = $request->file('file')->store('file');
        $this->import_file($path);
        \Storage::delete($path);
        $request->session()->flash('import_success',true);
        return redirect('/pegawai/import');
    }

    public function import_file($path)
    {
        \Excel::load('storage/app/'.$path)->get()->each(function($row){
            if($row->nama !=null){
                Pegawai::create([
                    'nama' => $row->nama,
                    'NIP' => ($row->nip=='-')?null:$row->nip,
                    'jabatan' => $row->jabatan,
                    'status' => $row->status,
                    'pangkat' => ($row->pangkat=='-'?null:$row->pangkat),
                    'NPWP' => $row->npwp
                ]);
            }
        });
    }
}
