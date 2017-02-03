@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <div class="pull-xs-left">
            <h2>Perjalanan Dinas</h2>
        </div>
        <div class="pull-xs-right m-t-30">
            <a href="{{route('perjalanandinas.create')}}" class="btn btn-primary">Tambah Perjalanan Dinas</a>
        </div>
    </div>
    <div class="panel panel-striped m-t-20">
        <div class="panel-body">
            <table class="table table-striped m-t-20" data-plugin="dataTable">
            <thead>
            <tr>
                @each('_table.head',['Kegiatan','Sub Kegiatan','Maksud','Tanggal','Action'],'text')
            </tr>
            </thead>
            <tbody>
            @foreach($perjalanan_dinas as $pd)
            <tr>
                <td>{{$pd->kegiatan->nama}}</td>
                <td>{{$pd->sub_kegiatan->nama}}</td>
                <td>{{$pd->maksud_perjalanan}}</td>
                <td>{{$pd->tanggal_berangkat}}</td>
                <td>
                    <a href="{{route('perjalanandinas.edit',['id'=>$pd->id])}}"><i class="wb-wrench"></i></a>
                    <a onclick="deletealert('/perjalanandinas/{{$pd->id}}')" href="#"><i class="wb-trash"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>
@endsection