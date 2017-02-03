<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\DPPA\Program;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_kode)
    {
        return redirect("/dppa/program/{$program_kode}");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($program_kode)
    {
        return view('dppa.program.kegiatan.create',['program_kode'=>$program_kode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$program_kode)
    {
        $program = Program::where('kode',$program_kode)->first();
        Kegiatan::create(['kode'=>$request->kode,'nama'=>$request->nama,'program_id'=>$program->id]);
        $request->session()->flash('data_created',true);
        return redirect("/dppa/program/{$program_kode}/kegiatan/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $kode
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        $kegiatan = Kegiatan::where('kode',$kode)->first();
        if($kegiatan == null) abort(404);
        $kegiatan->sub_kegiatan = $kegiatan->sub_kegiatan()->paginate(10);
        \Debugbar::info($kegiatan);
        $title = $kegiatan->nama;
        return view('dppa.program.kegiatan.show',['data'=>$kegiatan,'kegiatan_kode'=>$kode,'title'=>$title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $kode
     * @return \Illuminate\Http\Response
     */
    public function edit($kode, Request $request)
    {
        $kegiatan = Kegiatan::where('kode',$kode)->first();
        $ref = $request->ref;
        $title = $kegiatan->nama;
        return view("dppa.program.kegiatan.edit",['data'=>$kegiatan,'ref'=>$ref,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        Kegiatan::where('kode',$kode)->update(['kode'=>$request->kode,'nama'=>$request->nama]);
        $request->session()->flash('data_updated',true);
        return redirect(route('kegiatan.edit',['id'=>$kode]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($program_kode,$kode)
    {
        Kegiatan::where('kode',$kode)->delete($kode);
        return response('Success',200);
    }
}
