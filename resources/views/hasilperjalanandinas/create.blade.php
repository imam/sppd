@extends('layouts.app')

@section('content')
    <h2>Tambah Hasil Perjalanan Dinas</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('hasilperjalanandinas.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <h3>Kegiatan</h3>
            @include('_input.select2',['placeholder'=>'Pilih Kegiatan'])
        </div>
        <div class="col-lg-4">
            <h3>Sub Kegiatan</h3>
            @include('_input.select2',['placeholder'=>'Pilih Sub Kegiatan'])
        </div>
        <div class="col-lg-4">
            <h3>Perjalanan Dinas</h3>
            @include('_input.select2',['placeholder'=>'Pilih Perjalanan Dinas'])
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Administrasi</h3>
            <h4>Nomor Surat Perintah Tugas</h4>
            @include('_input.text',['placeholder'=>'Nomor Surat Perintah Tugas'])
        </div>
        <div class="col-lg-6">
            <h3>Petugas</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    @each('_table.head',['Nomor Surat Perjalanan Dinas','Nama Petugas','Ketua'],'text')
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <h3>Pejabat Berwenang di Tempat Tujuan</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            @each('_table.head',['NIP','Nama','Jabatan'],'text')
        </tr>
        </thead>
    </table>
    <div class="clearfix">
        <div class="pull-xs-right">
            <button class="btn btn-primary m-t-30">Submit</button>
        </div>
    </div>
@endsection