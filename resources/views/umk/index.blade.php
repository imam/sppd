@extends('layouts.app')

@section('content')
    <div class="clearfix">
            <div class="pull-xs-left">
                <h2>UMK</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('umk.create')}}" class="btn btn-primary">Buat UMK</a>
            </div>
        </div>
    <div>
    </div>
    <div class="panel panel-bordered m-t-20">
        <div class="panel-body">
            <table class="table table-striped" data-plugin="dataTable">
            <thead>
                <tr>
                    @each('_table.head',['Nomor','Kegiatan','Rekening Pengajuan','Persetujuan','Action'],'text')
                </tr>
            </thead>
            <tbody>
            @foreach($umk as $single)
                <tr>
                    <td>{{$single->id}}/UMK/{{$single->created_at->day}}/{{$single->created_at->month}}/{{$single->created_at->year}}</td>
                    <td>{{$single->kegiatan->nama}}</td>
                    <td><a href="#">Link</a></td>
                    <td><a href="#">Link</a></td>
                    <td>
                        <a href="{{route('umk.edit',['id'=>$single->id])}}"><i class="wb-edit"></i></a>
                        <a href="#"><i class="wb-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
    </table>
        </div>
    </div>

@endsection

@section('script')
@endsection