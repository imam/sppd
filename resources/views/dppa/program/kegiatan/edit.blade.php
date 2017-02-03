@extends('layouts.app')

@section('content')
    @include('_notification',['session_name'=>'data_updated','text'=>'Kegiatan Updated'])
    <h2>Edit Program</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="{{route('program.show',['id'=>$data->program->kode])}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="{{route('kegiatan.update',['id'=>$data->kode])}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <div class="panel-title">Kode Kegiatan</div>
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" placeholder="Kode Kegiatan" name="kode" value="{{$data->kode}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <div class="panel-title">Nama Kegiatan</div>
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama" value="{{$data->nama}}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
@endsection