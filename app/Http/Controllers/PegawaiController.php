<?php

namespace App\Http\Controllers;

use App\DPPA\Program;
use App\Pegawai;
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
        Pegawai::create([
            'nama'=>$request->nama,
            'nip'=>$request->nip,
            'jabatan'=>$request->jabatan,
            'status' =>$request->status,
            'pangkat' =>$request->pangkat,
            'npwp' =>$request->npwp
        ]);
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
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
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
        Pegawai::find($id)->update([
            'nama'=>$request->nama,
            'nip'=>$request->nip,
            'jabatan'=>$request->jabatan,
            'status' =>$request->status,
            'pangkat' =>$request->pangkat,
            'npwp' =>$request->npwp
        ]);
        $request->session()->flash('data_updated',true);
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
