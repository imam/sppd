@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <div class="pull-xs-left">
            <h2>Hasil Perjalanan Dinas</h2>
        </div>
        <div class="pull-xs-right m-t-30">
            <a href="{{route('hasilperjalanandinas.create')}}" class="btn btn-primary ">Tambah Hasil Perjalanan Dinas</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>

            @each('_table.head',['Kegiatan','Sub Kegiatan','Perjalanan','Tanggal','Petugas','Action'],'text')
        </tr>
        </thead>
    </table>
@endsection
