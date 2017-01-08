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
    <table class="table table-striped m-t-20">
        <thead>
        <tr>
            @each('_table.head',['Kegiatan','Sub Kegiatan','Maksud','Tanggal','Action'],'text')
        </tr>
        </thead>
    </table>
@endsection