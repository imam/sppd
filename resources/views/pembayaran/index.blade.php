@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <div class="pull-xs-left">
            <h2>Pembayaran</h2>
        </div>
        <div class="pull-xs-right m-t-30">
            <a href="{{route('pembayaran.create')}}" class="btn btn-primary ">Tambah Pembayaran</a>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                @each('_table.head',['Kegiatan','Perjalanan','Tanggal'],'text')
            </tr>
            </thead>
            <tbody>
            <tr>
            </tr>
            </tbody>
        </table>
    </div>
@endsection