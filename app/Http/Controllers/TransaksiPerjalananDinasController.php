<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\TransaksiPerjalananDinas;
use App\Pegawai;
use Illuminate\Http\Request;
use Validator;

class TransaksiPerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksiperjalanandinas = TransaksiPerjalananDinas::with('perjalanan_dinas.kegiatan','petugas','petugas.pegawai','pejabat')->get();
        \Debugbar::info($transaksiperjalanandinas);
        \JavaScript::put([
            'transaksiperjalanandinas' => $transaksiperjalanandinas
        ]);
        return view('transaksiperjalanandinas.index',compact('transaksiperjalanandinas'));
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
        $transaksiperjalanandinas = TransaksiPerjalananDinas::with('petugas','pejabat','ketua_perjalanan')->find(1);
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        \JavaScript::put([
            'kegiatan' => $kegiatan,
            'pegawai' => $pegawai,
            'transaksiperjalanandinas' => $transaksiperjalanandinas,
            'oldinput' => $oldinput
        ]);
        return view('transaksiperjalanandinas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'perjalanan_dinas_id' =>'required',
            'nomor_surat' =>'required',
            'ketua_perjalanan_id' => 'required',
            'petugas' => 'required',
            'petugas.*.nomor_surat' => 'required',
            'petugas.*.pegawai_id' => 'required'
        ]);
        $transaksiperjalanandinas = TransaksiPerjalananDinas::create($request->all());
        $petugas = collect($request->all()['petugas']);
        $petugas->each(function($p)use($transaksiperjalanandinas){
            $transaksiperjalanandinas->petugas()->create($p);
        });
        $pejabat = collect($request->all()['pejabat']);
        $pejabat->each(function($p)use($transaksiperjalanandinas){
            $transaksiperjalanandinas->pejabat()->create($p);
        });
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::all();
        \JavaScript::put([
            'kegiatan' => $kegiatan,
            'pegawai' => $pegawai,
            'transaksiperjalanandinas'=> $transaksiperjalanandinas
        ]);
        $request->session()->flash('data_created',true);
        return redirect(route('transaksiperjalanandinas.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksiperjalanandinas = TransaksiPerjalananDinas::with('perjalanan_dinas','ketua_perjalanan')->find($id);
        \Debugbar::info($transaksiperjalanandinas);
        return view('transaksiperjalanandinas.show',compact('transaksiperjalanandinas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::active()->get();
        $transaksiperjalanandinas = TransaksiPerjalananDinas::with('petugas','pejabat','ketua_perjalanan')->find(1);
        $current = TransaksiPerjalananDinas::with('petugas','pejabat','ketua_perjalanan')->find($id);
        $current->kegiatan_id = $current->perjalanan_dinas->kegiatan->id;
        $current->sub_kegiatan_id = $current->perjalanan_dinas->sub_kegiatan->id;
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        \JavaScript::put([
            'kegiatan' => $kegiatan,
            'pegawai' => $pegawai,
            'transaksiperjalanandinas' => $transaksiperjalanandinas,
            'current' => $current,
            'oldinput' => $oldinput
        ]);
        return view('transaksiperjalanandinas.edit',compact('current','oldinput'));
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
            'perjalanan_dinas_id' =>'required',
            'nomor_surat' =>'required',
            'ketua_perjalanan_id' => 'required',
            'petugas' => 'required',
            'petugas.*.nomor_surat' => 'required',
            'petugas.*.pegawai_id' => 'required'
        ]);
        $transaksiperjalanandinas = TransaksiPerjalananDinas::find($id);
        $transaksiperjalanandinas->update($request->all());
        $transaksiperjalanandinas->petugas()->delete();
        $transaksiperjalanandinas->pejabat()->delete();
        $petugas = collect($request->all()['petugas']);
        $petugas->each(function($p)use($transaksiperjalanandinas){
            $transaksiperjalanandinas->petugas()->create($p);
        });
        $pejabat = collect($request->all()['pejabat']);
        $pejabat->each(function($p)use($transaksiperjalanandinas){
            $transaksiperjalanandinas->pejabat()->create($p);
        });
        $kegiatan = Kegiatan::all();
        $pegawai = Pegawai::all();
        \JavaScript::put([
            'kegiatan' => $kegiatan,
            'pegawai' => $pegawai,
            'transaksiperjalanandinas'=> $transaksiperjalanandinas
        ]);
        $request->session()->flash('data_updated',true);
        return redirect(route('transaksiperjalanandinas.edit',['id'=>$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiPerjalananDinas::find($id)->delete();
        return response('ok');
    }
}
