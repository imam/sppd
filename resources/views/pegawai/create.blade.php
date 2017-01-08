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
    <h2>Tambah Pegawai</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/pegawai" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="/pegawai" method="post">

        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Nama
                </h4>
                <input type="text" class="form-control" placeholder="Nama" name="nama">
            </div>
            <div class="col-lg-6">
                <h4>
                    NIP
                </h4>
                <input type="text" class="form-control" placeholder="NIP" name="nip">
            </div>


        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Jabatan
                </h4>
                <input type="text" class="form-control" placeholder="Jabatan" name="jabatan">
            </div>
            <div class="col-lg-6">
                <h4>
                    Status
                </h4>
                <input type="text" class="form-control" placeholder="Status" name="status">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Pangkat
                </h4>
                <input type="text" class="form-control" placeholder="Pangkat" name="pangkat">
            </div>
            <div class="col-lg-6">
                <h4>
                    NPWP
                </h4>
                <input type="text" class="form-control" placeholder="NPWP" name="npwp">
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
@endsection