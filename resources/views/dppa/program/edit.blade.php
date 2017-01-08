@extends('layouts.app')

@section('content')

    @include('_notification',['session_name'=>'data_updated','text'=>'Program Updated'])
    <h2>Edit Program</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/dppa/{{$data->tahun_anggaran}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="{{route('program.update',$data->kode)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Kode program
                </h4>
                <input type="text" class="form-control" placeholder="Kode Program" name="kode" value="{{$data->kode}}">
            </div>
            <div class="col-lg-6">
                <h4>
                    Nama program
                </h4>
                <input type="text" class="form-control" placeholder="Nama Program" name="nama" value="{{$data->nama}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
@endsection