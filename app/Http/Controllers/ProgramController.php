<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\DPPA\Program;
use App\Dppa\Sub_Kegiatan;
use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \App\DPPA\Program::orderBy('kode')->paginate(10);
        \Debugbar::info($data->previousPageUrl());
        return view('dppa.program.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dppa.program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Program::create(['kode'=>$request->kode,'nama'=>$request->nama]);
        $request->session()->flash('data_created',true);
        return redirect('/dppa/program/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $program = Program::where('kode',$id)->first();
        if($program == null) abort(404);
        \Debugbar::info($program);
        $title = $program->nama;
        return view('dppa.program.show',['data'=>$program,'title'=>$title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode, Request $request)
    {
        $program = Program::where('kode',$kode)->first();
        \Debugbar::info($program);
        return view('dppa.program.edit',['data'=>$program]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $kode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required'
        ]);
        $program = Program::where('kode',$kode)->first();
        $program->kode = $request->kode;
        $program->nama = $request->nama;
        $program->save();
        $request->session()->flash('program_edited',true);
        return redirect(route('program.edit',['id'=>$kode]));
    }
}
