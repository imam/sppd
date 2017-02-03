<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\HasilPerjalananDinas;
use App\Pegawai;
use Illuminate\Http\Request;

class HasilPerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hasilperjalanandinas.index',['hasilperjalanandinas'=>HasilPerjalananDinas::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pegawai = Pegawai::active()->get();
        $kegiatan = Kegiatan::all();
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        \JavaScript::put([
            'pegawai'=> $pegawai,
            'kegiatan' => $kegiatan,
            'oldinput' => $oldinput
        ]);
        return view('hasilperjalanandinas.create',compact('pegawai','oldinput'));
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
            'perjalanan_dinas_id' => 'required'
        ]);
        if($request->file){
            $filepath = $request->file('file')->store('file');
        }else{
            $filepath = '';
        }
        HasilPerjalananDinas::create([
            'hasil' => $request->hasil,
            'file' => $filepath,
            'perjalanan_dinas_id' => $request->perjalanan_dinas_id
        ]);
        $request->session()->flash('data_created',true);
        return redirect(route('hasilperjalanandinas.create'));
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
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $pegawai = Pegawai::get();
        $kegiatan = Kegiatan::all();
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        $hasilperjalanandinas = HasilPerjalananDinas::with('perjalanan_dinas.kegiatan','perjalanan_dinas.sub_kegiatan')->find($id);
        \JavaScript::put([
            'pegawai'=> $pegawai,
            'kegiatan' => $kegiatan,
            'oldinput' => $oldinput,
            'current' => $hasilperjalanandinas
        ]);
        return view('hasilperjalanandinas.edit',compact('pegawai','oldinput','hasilperjalanandinas'));
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
        $this->validate($request,[
            'perjalanan_dinas_id' => 'required'
        ]);
        $hasilperjalanandinas = HasilPerjalananDinas::find($id);
        if($request->file){
            $file = $request->file('file')->store('file');
            $hasilperjalanandinas->file = $file;
        }
        $hasilperjalanandinas->update($request->all());
        $hasilperjalanandinas->save();
        $request->session()->flash('data_updated',true);
        return redirect(route('hasilperjalanandinas.edit',['id'=>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HasilPerjalananDinas::destroy($id);
        return response('ok');
    }

    public function download($id)
    {
        $filepath = public_path().'/../storage/app/'.HasilPerjalananDinas::find($id)->file;
        return response()->download($filepath,'download.'.pathinfo($filepath)['extension']);
    }
}
