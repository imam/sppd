@extends('layouts.app')

@section('content')
    <div id="root">
    <h2>{{$data->nama}}</h2>
    <div class="m-t-30">
        <a href="{{route('dppa.index')}}" class="btn btn-primary m-r-20">Ubah Program</a>
        <a href="{{route('program.show',['id'=>$data->program->kode])}}" class="btn btn-primary m-r-20">Ubah Kegiatan</a>

    </div>
    <div class="panel panel-bordered m-t-20">
        <div class="panel-heading">
            <div class="panel-title">Info</div>
        </div>
        <div class="panel-body">
            <ul>
                <li><strong>Kode Sub-Kegiatan: </strong>{{$data->kode}}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <div class="panel-title">Sub Kegiatan</div>
        </div>
        <div class="panel-body">
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
                <td>{{$sub_kegiatan->kode_rekening}}</td>
                <td>{{$sub_kegiatan->uraian}}</td>
                <td>{{ 'Rp '. number_format($sub_kegiatan->jumlah_anggaran)}}</td>
                <td>
                    @if($sub_kegiatan->editable && Entrust::hasRole(['admin','supervisor']))
                        <a href="{{route('subkegiatan.edit',['id'=>$sub_kegiatan->id])}}"><i class="wb-edit"></i></a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
        @include('_table.pagination',['data'=>$data->sub_kegiatan])
    </div>
@endsection


@section('script')
@endsection