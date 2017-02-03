<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\Pegawai;
use App\PerjalananDinas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerjalananDinasController extends Controller
{

    private $errors;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perjalanan_dinas = PerjalananDinas::all();
        return view('perjalanandinas.index',compact('perjalanan_dinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::active()->get();
        return view('perjalanandinas.create',compact('kegiatan','pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->modelValidation($request)){
            return response($this->errors,422);
        }
        try{
            $data = $this->date_formatting($request, ['tanggal_berangkat','tanggal_pulang','tanggal_referensi']);
            PerjalananDinas::create($data);
        } catch (\Exception $e){
            return response($e->getMessage(),422);
        }
        return response($request->all(), 200);
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
        $perjalanan_dinas = PerjalananDinas::find($id);
        \JavaScript::put([
            'perjalanan_dinas'=>$perjalanan_dinas
        ]);
        return view('perjalanandinas.edit',compact('kegiatan','pegawai'));
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
        if(!$this->modelValidation($request)){
            return response($this->errors,422);
        }
        try{
            $data = $this->date_formatting($request,['tanggal_berangkat','tanggal_pulang','tanggal_referensi']);
            PerjalananDinas::find($id)->update($data);
        } catch (\Exception $e){
            return response($e->getMessage(),422);
        }
        return response('ok',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PerjalananDinas::find($id)->delete();
        return ('ok');
    }

    private function date_formatting(Request $request, $array)
    {
        $data = $request->all();
        foreach ($data as $key => $value){
            if(in_array($key,$array)){
                $carbon = Carbon::createFromFormat('d/m/Y',$request->$key);
                $data[$key] = $carbon->toDateString();
            }
        }
        return $data;
    }

    public function modelValidation($request)
    {
        $validator = \Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'sub_kegiatan_id' => 'required',
            'tempat_berangkat' => 'required',
            'tempat_tujuan' => 'required',
            'tanggal_berangkat' => 'required',
            'tanggal_pulang' => 'required',
            'referensi_perjalanan' => 'required',
            'nomor_referensi'=> 'required',
            'tanggal_referensi'=> 'required',
            'jenis_perjalanan'=> 'required',
            'tingkat_biaya_perjalanan_dinas'=> 'required',
            'maksud_perjalanan'=> 'required',
            'alat_angkutan_yang_digunakan'=> 'required',
            'keterangan_lain_lain'=> 'required',
            'pejabat_pelaksana_teknis_kegiatan'=> 'required',
            'pejabat_pengadaan_barang_dan_jasa'=> 'required',
            'pejabat_kuasa_pengguna_anggaran'=> 'required'
        ]);
        if($validator->fails()){
            $this->errors = collect($validator->errors())->flatten();
            return false;
        }
        return true;
    }

}
