<?php

namespace App\Http\Controllers\API\DPPA;

use App\Dppa\Kegiatan;
use App\Dppa\Sub_Kegiatan;
use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\DPPA\Program::orderBy('kode')->paginate(10);
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
        //
    }

    public function store_import(Request $request)
    {
        $path = $request->file('file')->store('file');
        $excel = \Excel::load('storage/app/'.$path)->get()->each(function($row){
            $row->each(function ($data){
                if ($data->kode_program != null) {
                    $program = $this->find_or_create_program($data);
                    $kegiatan = Kegiatan::firstOrCreate(['kode'=>$data->kode_kegiatan],
                        [
                            'kode'=>$data->kode_kegiatan,
                            'nama'=>$data->nama_kegiatan,
                            'program_id'=>$program->id
                        ]);
                    $uraian = Uraian_Sub_Kegiatan::firstOrCreate(['kode_rekening'=>$data->kode_rekening],
                        ['kode_rekening'=>$data->kode_rekening,'uraian'=>$data->uraian]);
                    $sub_kegiatan = Sub_Kegiatan::create(['nama'=>$data->sub_kegiatan,'jumlah_anggaran'=>$data->anggaran,
                        'kegiatan_id'=>$kegiatan->id,'uraian_id'=>$uraian->id]);

                }
            });
        });
        $request->session()->flash('import_success','true');
        return redirect('/dppa/program/import');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = \App\DPPA\Program::find($id);
        $program->kegiatan = $program->kegiatan()->orderBy('kode')->paginate(10);
        return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    private function find_or_create_program($data){
        return \App\DPPA\Program::firstOrCreate(['kode'=>$data->kode_program],['kode' => $data->kode_program, 'nama' => $data->nama_program]);
    }
}
