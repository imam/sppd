<?php

namespace App\Http\Controllers;

use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Http\Request;

class UraianSubKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Uraian_Sub_Kegiatan::create(['uraian'=>$request->uraian,'kode_rekening'=>$request->kode_rekening]);
        return redirect($request->ref);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($program_id, $kegiatan_id, $id,Request $request)
    {
        $uraian = Uraian_Sub_Kegiatan::find($id)->update(['uraian'=>$request->uraian,'kode_rekening'=>$request->kode_rekening]);
        return redirect($request->ref);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($program_kode,$kegiatan_kode,$id, Request $request)
    {
        Uraian_Sub_Kegiatan::find($id)->delete();
        return response('Success',200);
    }
}
