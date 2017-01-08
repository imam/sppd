@extends('layouts.app')

@section('content')
    <h2>Tambah Perjalanan</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('perjalanandinas.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <h3>Kegiatan</h3>
    <select name="kegiatan" class="form-control" data-placeholder="Pilih Kegiatan" data-plugin="select2">
        <option value=""></option>
        <option value="a">Halo</option>
    </select>

    @include('_informasianggaran')

    <div class="row">
        <div class="col-lg-6">
            <h3>Lokasi dan Waktu</h3>
            <h4>Tempat Berangkat</h4>
            <input class="form-control" type="text" name="tempat_berangkat" placeholder="Tempat Berangkat">
            <h4>Tempat Tujuan</h4>
            <input class="form-control" type="text" name="tempat_tujuan" placeholder="Tempat Tujuan">
            <div class="row input-daterange text-xs-left" data-plugin="datepicker" data-start-date="now">
                <div class="col-lg-6">
                    <h4>Tanggal Berangkat</h4>
                    @include('_input.text',['placeholder'=>'Tanggal Berangkat'])
                </div>
                <div class="col-lg-6">
                    <h4>Tanggal Pulang</h4>
                    @include('_input.text',['placeholder'=>'Tanggal Pulang'])
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h3>Referensi</h3>
            <h4>Referensi Perjalanan</h4>
            @include('_input.text',['placeholder'=>'Referensi Perjalanan'])
            <h4>Nomor Referensi</h4>
            @include('_input.text',['placeholder'=>'Nomor Referensi'])
            <h4>Tanggal Referensi</h4>
            @include('_input.text',['placeholder'=>'Tanggal Referensi'])
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3>Detail Kegiatan</h3>
            <h4>Jenis Perjalanan</h4>
            @include('_input.text',['placeholder'=>'Jenis Perjalanan'])
            <h4>Tingkat Biaya Perjalanan Dinas</h4>
            @include('_input.text',['placeholder'=>'Tingkat Biaya Perjalanan dinas'])
            <h4>Maksud Perjalanan</h4>
            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Maksud Perjalanan"></textarea>
            <h4>Alat Angkutan yang Digunakan</h4>
            @include('_input.text',['placeholder'=>'Alat Angkutan yang Digunakan'])
            <h4>Keterangan Lain-Lain</h4>
            <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Keterangan Lain-Lain"></textarea>
        </div>
        <div class="col-lg-6">
            <h3>Persetujuan</h3>
            <h4>Pejabat Pelaksana Teknis Kegiatan</h4>
            @include('_input.text',['placeholder'=>'Pejabat Pelaksana Teknis Kegiatan','name'=> 'kepo'])
            <h4>Pejabat Pengadaan Barang dan Jasa</h4>
            @include('_input.text',['placeholder'=>'Pejabat Pengadaan Barang dan Jasa','name'=> 'kepo'])
            <h4>Kuasa Pengguna Anggaran</h4>
            @include('_input.text',['placeholder'=>'Kuasa Pengguna Anggaran','name'=>'uwupwup'])
        </div>
    </div>
    <button type="submit" class="btn btn-primary m-t-10">Submit</button>

@endsection