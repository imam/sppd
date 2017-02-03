<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\Pegawai;
use App\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('petugas_pembayaran','petugas_pembayaran.pegawai')->get();
        \JavaScript::put([
            'pembayaran' => $pembayaran
        ]);
        return view('pembayaran.index', compact('pembayaran'));
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
        return view('pembayaran.create',compact('pegawai','oldinput'));
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
            'kegiatan_id' => 'required',
            'sub_kegiatan_id' => 'required',
            'perjalanan_dinas_id' => 'required',
            'petugas' => "required",
            'petugas.*.petugas_id' => 'required',
            'petugas.*.uang' => 'required|integer',
            'petugas.*.transport' => 'required|integer',
            'petugas.*.penginapan' => 'required|integer'
        ]);
        $pembayaran = Pembayaran::create($request->all());
        foreach ($request->petugas as $p){
            $pembayaran->petugas_pembayaran()->create($p);
        }
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with('petugas_pembayaran.pegawai')->find($id);
        \JavaScript::put([
            'pembayaran'=>$pembayaran
        ]);
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        $pegawai = Pegawai::active()->get();
        $kegiatan = Kegiatan::all();
        $current = Pembayaran::with(
            'petugas_pembayaran.pegawai','perjalanan_dinas.kegiatan','perjalanan_dinas.sub_kegiatan'
        )->find($id);
        $oldinput = $request->session()->hasOldInput()?$request->session()->getOldInput():null;
        \JavaScript::put([
            'pegawai'=> $pegawai,
            'kegiatan' => $kegiatan,
            'current' => $current,
            'oldinput' => $oldinput
        ]);
        return view('pembayaran.edit',compact('pegawai','current'));
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
        $this->validate($request, [
            'kegiatan_id' => 'required',
            'sub_kegiatan_id' => 'required',
            'perjalanan_dinas_id' => 'required',
            'petugas' => "required",
            'petugas.*.petugas_id' => 'required',
            'petugas.*.uang' => 'required|integer',
            'petugas.*.transport' => 'required|integer',
            'petugas.*.penginapan' => 'required|integer'
        ]);
        $pembayaran = Pembayaran::find($id);
        $pembayaran->update($request->all());
        $pembayaran->petugas_pembayaran()->delete();
        foreach ($request->petugas as $p){
            $pembayaran->petugas_pembayaran()->create($p);
        }
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pembayaran::find($id)->delete();
        return response('ok');
    }
}
