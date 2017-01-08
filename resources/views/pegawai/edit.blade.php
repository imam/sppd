@extends('layouts.app')

@section('content')
    @include('_notification',['session_name'=>'data_updated','text'=>'Pegawai Updated'])
    <h2>Tambah Pegawai</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/pegawai/" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="/pegawai/{{$pegawai->id}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Nama
                </h4>
                <input value="{{$pegawai->nama}}" type="text" class="form-control" placeholder="Nama" name="nama">
            </div>
            <div class="col-lg-6">
                <h4>
                    NIP
                </h4>
                <input value="{{$pegawai->NIP}}"type="text" class="form-control" placeholder="NIP" name="nip">
            </div>


        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Jabatan
                </h4>
                <input value="{{$pegawai->jabatan}}"type="text" class="form-control" placeholder="Jabatan" name="jabatan">
            </div>
            <div class="col-lg-6">
                <h4>
                    Status
                </h4>
                <input value="{{$pegawai->status}}"type="text" class="form-control" placeholder="Status" name="status">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Pangkat
                </h4>
                <input value="{{$pegawai->pangkat}}" type="text" class="form-control" placeholder="Pangkat" name="pangkat">
            </div>
            <div class="col-lg-6">
                <h4>
                    NPWP
                </h4>
                <input value="{{$pegawai->NPWP}}"type="text" class="form-control" placeholder="NPWP" name="npwp">
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
@endsection