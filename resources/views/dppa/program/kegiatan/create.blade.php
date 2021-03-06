@extends('layouts.app')

@section('content')
    @if(Session::get('data_created') ===true)
        <div class="alert dark alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            Data created
        </div>
    @endif
    <h2>Tambah Program</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/dppa/program/{{$program_kode}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="/dppa/program/{{$program_kode}}/kegiatan" method="post">

        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Kode Kegiatan
                </h4>
                <input type="text" class="form-control" placeholder="Kode Kegiatan" name="kode">
            </div>
            <div class="col-lg-6">
                <h4>
                    Nama Kegiatan
                </h4>
                <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama">
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
@endsection