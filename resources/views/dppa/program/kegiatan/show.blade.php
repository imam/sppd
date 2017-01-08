@extends('layouts.app')

@section('content')
    <div id="root">
    <h2>{{$data->nama}}</h2>
    <div class="m-t-30">
        <a href="{{route('dppa.index')}}" class="btn btn-primary m-r-20">Ubah Program</a>
        <a href="{{route('program.show',['id'=>$data->program->kode])}}" class="btn btn-primary m-r-20">Ubah Kegiatan</a>

    </div>
    <h3>Info</h3>
    <ul>
        <li><strong>Kode Sub-Kegiatan: </strong>{{$data->kode}}</li>
    </ul>
    <div class="clearfix">
        <div class="pull-xs-left">
                <h3>Sub Kegiatan</h3>
        </div>
        <div class="pull-xs-right m-t-20">
        </div>
    </div>
    <table class="table table-striped" v-if="data_loaded" data-plugin="dataTable">
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
            <th>{{$sub_kegiatan->kode_rekening}}</th>
            <td>{{$sub_kegiatan->uraian}}</td>
            <th>{{ 'Rp '. number_format($sub_kegiatan->jumlah_anggaran)}}</th>
            <th><a href="{{route('subkegiatan.edit',['id'=>$sub_kegiatan->id])}}"><i class="wb-edit"></i></a></th>
        </tr>
        @endforeach
        </tbody>
    </table>
        @include('_table.pagination',['data'=>$data->sub_kegiatan])
    </div>
@endsection


@section('script')
@endsection