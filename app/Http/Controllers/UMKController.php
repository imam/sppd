<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Dppa\Kegiatan;
use App\DPPA\Program;
use App\Pegawai;
use App\TahunAnggaran;
use App\UMK;
use Illuminate\Http\Request;

class UMKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umk = UMK::all();
        return view('umk.index',compact('umk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::all();
        return view('umk.create',compact('kegiatan','pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response($request->all(),200);
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
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::all();
        $umk = UMK::with('rekening_pengajuan')->find($id);
        foreach($umk->rekening_pengajuan as $key=> $value){
            $umk->rekening_pengajuan[$key]->sub_kegiatan = $value->sub_kegiatan_id;
        }
        JavaScript::put([
            'umk'=>$umk
        ]);
        return view('umk.edit',compact('kegiatan','pegawai'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
