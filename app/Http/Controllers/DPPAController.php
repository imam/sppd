<?php

namespace App\Http\Controllers;

use App\Dppa\Kegiatan;
use App\DPPA\Program;
use App\Dppa\Sub_Kegiatan;
use App\Dppa\Uraian_Sub_Kegiatan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;

class DPPAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Program::all();
        return view('dppa.show',compact('data','tahun_anggaran'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tahun_anggaran, Request $request)
    {
        $data = Program::where('tahun_anggaran',$tahun_anggaran);
        if($data->get()->isEmpty()) abort(404);
        $data = $data->paginate(10);
        return view('dppa.show',compact('data','tahun_anggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {



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

    public function import(Request $request)
    {

        return view('dppa.import');
    }

    public function import_store(Request $request)
    {
        $this->validate($request,[
            'file'=>'required|file'
        ]);
        $path = $request->file('file')->store('file');
        $this->import_file($path, 2016);
        \Storage::delete($path);
        $request->session()->flash('import_success',true);
        return redirect('dppa/import');
    }

    public function import_file( $path, $tahun_anggaran)
    {
        \Excel::load('storage/app/'.$path)->get()->each(function($row)use($tahun_anggaran){
            $row->each(function($data)use($tahun_anggaran){
                if($data->kode_program !==null){
                    $program = Program::firstOrCreate(['kode'=>$data->kode_program],[
                        'kode' => $data->kode_program,
                        'nama' => $data->nama_program,
                        'tahun_anggaran' => $tahun_anggaran
                    ]);
                    $kegiatan = Kegiatan::firstOrCreate(['kode'=>$data->kode_kegiatan],
                        [
                            'kode'=>$data->kode_kegiatan,
                            'nama'=>$data->nama_kegiatan,
                            'program_id'=>$program->id
                    ]);
                    Sub_Kegiatan::create([
                        'nama'=>$data->sub_kegiatan,
                        'jumlah_anggaran'=>$data->anggaran,
                        'uraian'=>$data->uraian,
                        'kode_rekening'=>$data->kode_rekening,
                        'kegiatan_id'=>$kegiatan->id,
                    ]);
                }
            });
        });
    }
}
