<?php

namespace App\Http\Controllers;

use App\Dppa\Sub_Kegiatan;
use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Http\Request;

class SubKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id, $kegiatan_id)
    {
        return response()->redirectTo("/dppa/program/$program_id/kegiatan/$kegiatan_id");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($program_kode,$kegiatan_kode)
    {
        $uraian = Uraian_Sub_Kegiatan::all();
        return view('dppa.program.kegiatan.subkegiatan.create',compact('program_kode','kegiatan_kode','uraian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$program_kode,$kegiatan_kode)
    {
        Sub_Kegiatan::create(['nama'=>$request->nama,'jumlah_anggaran'=>$request->jumlah_anggaran,
            'kegiatan_id'=>$request->kegiatan_id,'uraian_id'=>$request->uraian_id]);
        $request->session()->flash('data_created',true);
        return redirect("/dppa/program/$program_kode/kegiatan/$kegiatan_kode/subkegiatan/create");
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
    public function edit($sub_kegiatan_id)
    {
        $sub_kegiatan = Sub_Kegiatan::find($sub_kegiatan_id);
        $uraian = Uraian_Sub_Kegiatan::all();
        return view('dppa.program.kegiatan.subkegiatan.edit',compact('uraian','sub_kegiatan','sub_kegiatan_id'));
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
        $sub_kegiatan  = Sub_Kegiatan::find($id)->update([
            'nama'=>$request->nama,
            'jumlah_anggaran'=>$request->jumlah_anggaran,
            'uraian'=>$request->uraian,
            'kode_rekening'=>$request->kode_rekening
        ]);
        if($sub_kegiatan == null) abort(404);
        $request->session()->flash('data_updated',true);
        return redirect(route('subkegiatan.edit',['id'=>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($program_kode,$kegiatan_kode,$id)
    {
        Sub_Kegiatan::find($id)->delete();
        return response('success',200);
    }
}
