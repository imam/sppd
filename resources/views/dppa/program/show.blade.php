@extends('layouts.app')

@section('content')
    <div id="root" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <h2>{{$data->nama}}</h2>
        <div class="m-t-30">
            <a href="{{route('dppa.index')}}" class="btn btn-primary m-r-20">Ubah Program</a>
        </div>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-heading">
                <div class="panel-title">Info</div>
            </div>
            <div class="panel-body">
                <ul>
                    <li><strong>Kode Program: </strong>{{$data->kode}}</li>
                </ul>
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Kegiatan</div>
            </div>
            <div class="panel-body">
                <table data-plugin="dataTable" class="table table-striped">
                <thead>
                <tr>
                    @each('_table.head',['Kode','Nama','Jumlah Anggaran','Action'],'text')
                </tr>
                </thead>
                <tbody>
                @foreach($data->kegiatan as $kegiatan)
                    <tr>
                        <td>{{$kegiatan->kode}}</td>
                        <td><a href="{{route('kegiatan.show',['id'=>$kegiatan->kode])}}">{{ $kegiatan->nama  }}</a></td>
                        <td>{{ 'Rp '. number_format($kegiatan->jumlah_anggaran)}}</td>
                        <td>
                            @if($kegiatan->editable && Entrust::hasRole(['admin','supervisor']))
                                @include('_crud.edit_item',['edit_url'=>route('kegiatan.edit',['id'=>$kegiatan->kode])])
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>

@endsection
