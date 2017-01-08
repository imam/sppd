@extends('layouts.app')

@section('content')
    <div id="root" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <h2>{{$data->nama}}</h2>
        <div class="m-t-30">
            <a href="{{route('dppa.index')}}" class="btn btn-primary m-r-20">Ubah Program</a>
        </div>
        <h3>Info</h3>
        <ul>
            <li><strong>Kode Program: </strong>{{$data->kode}}</li>
        </ul>
        <div class="clearfix">
            <div class="pull-xs-left">
                <h3>Kegiatan</h3>
            </div>
        </div>
        <table data-plugin="dataTable" class="table table-striped">
            <thead>
            <tr>
                @each('_table.head',['Kode','Nama','Jumlah Anggaran','Action'],'text')
            </tr>
            </thead>
            <tbody>
            @foreach($data->kegiatan as $kegiatan)
                <tr>
                    <th>{{$kegiatan->kode}}</th>
                    <th><a href="{{route('kegiatan_id',['id'=>$kegiatan->kode])}}">{{ $kegiatan->nama  }}</a></th>
                    <th>{{ 'Rp '. number_format($kegiatan->jumlah_anggaran)}}</th>
                    <th>
                        @include('_crud.edit_item',['edit_url'=>route('kegiatan_id',['id'=>$kegiatan->kode])])
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>

@endsection
