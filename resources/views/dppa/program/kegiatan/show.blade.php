@extends('layouts.app')

@section('content')
    <div id="root">
    <h2>{{$data->nama}}</h2>
    <div class="m-t-30">
            <a href="/dppa/program/1/edit" class="btn btn-primary m-r-20">Edit Program</a>
            <a href="/dppa/program/{{$data->program->kode}}" class="btn btn-primary m-r-20">Kembali Ke Halaman Sebelumnya</a>
        </div>
    <h3>Info</h3>
    <ul>
        <li><strong>Kode Sub-Kegiatan: </strong>{{$data->kode}}</li>
    </ul>
    <div class="clearfix">
        </div>
        <div class="pull-xs-right m-t-20">
            <a href="#" class="btn btn-primary btn-sm">Tambah Sub-Kegiatan</a>
            <a href="#" class="btn btn-primary btn-sm">Impor Sub-Kegiatan</a>
            <a href="#" class="btn btn-primary btn-sm">Ekspor Sub-Kegiatan</a>
        </div>
    </div>
    <table class="table table-striped" v-if="data_loaded">
        <thead>
        <tr>
            <th>Nama Sub-Kegiatan</th>
            <th>Kode Rekening</th>
            <th>Uraian</th>
            <th>Jumlah Anggaran</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data->sub_kegiatan as $sub_kegiatan)
        <tr>
            <td>{{$sub_kegiatan->nama}}</td>
            <th>{{$sub_kegiatan->uraian->kode_rekening}}</th>
            <td>{{$sub_kegiatan->uraian->uraian}}</td>
            <th>{{ 'Rp '. number_format($sub_kegiatan->jumlah_anggaran)}}</th>
            <th><a href="#"><i class="wb-edit"></i></a> <a href="#"><i class="wb-trash"></i></a></th>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection


@section('script')
@endsection