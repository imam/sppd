<?php

namespace App\Http\Controllers;

use App\RekeningPengajuan;
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
        Javascript::put([
            'umk' => UMK::with(
                'rekening_pengajuan',
                'rekening_pengajuan.sub_kegiatan',
                'pejabat_pelaksana_teknis_kegiatan_pegawai',
                'pejabat_pengadaan_barang_dan_jasa_pegawai',
                'pejabat_kuasa_pengguna_anggaran_pegawai'
            )->get()
        ]);
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
        $pegawai = Pegawai::active()->get();
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
        $validator = \Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'rekening_pengajuan' => 'required',
            'rekening_pengajuan.*.sub_kegiatan_id' => 'required',
            'rekening_pengajuan.*.jumlah' => 'required',
            'pejabat_kuasa_pengguna_anggaran_pegawai_id' => 'required',
            'pejabat_pelaksana_teknis_kegiatan_pegawai_id' => 'required',
            'pejabat_pengadaan_barang_dan_jasa_pegawai_id' => 'required'
        ]);
        if($validator->fails()){
            return response(collect($validator->errors())->flatten(),422);
        }
        $umk = UMK::create($request->all());
        foreach($request->rekening_pengajuan as $rp){
            $umk->rekening_pengajuan()->save(new RekeningPengajuan($rp));
        }
        return response($umk);
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
        $pegawai = Pegawai::active()->get();
        $umk = UMK::with('rekening_pengajuan')->find($id);
        foreach($umk->rekening_pengajuan as $key=> $value){
            $umk->rekening_pengajuan[$key]->sub_kegiatan = $value->sub_kegiatan_id;
        }
        JavaScript::put([
            'umk'=>$umk
        ]);
        return view('umk.edit',compact('kegiatan','pegawai','rekening_pengajuan'));
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
        $validator = \Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'rekening_pengajuan' => 'required',
            'rekening_pengajuan.*.sub_kegiatan_id' => 'required',
            'rekening_pengajuan.*.jumlah' => 'required',
            'pejabat_kuasa_pengguna_anggaran_pegawai_id' => 'required',
            'pejabat_pelaksana_teknis_kegiatan_pegawai_id' => 'required',
            'pejabat_pengadaan_barang_dan_jasa_pegawai_id' => 'required'
        ]);
        if($validator->fails()){
            return response(collect($validator->errors())->flatten(),422);
        }
        $umk = UMK::find($id);
        $umk->update($request->all());
        RekeningPengajuan::where('umk_id',$id)->each(function($rp){
            $rp->delete();
        });
        foreach($request->rekening_pengajuan as $rp){
            $umk->rekening_pengajuan()->save(new RekeningPengajuan($rp));
        }
        return response($umk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UMK::find($id)->delete();
        return response('ok',200);
    }
}
