@extends('layouts.app')

@section('content')
    <div id="root" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <h2>{{$data->nama}}</h2>
        <div class="m-t-30">
            <a href="/dppa/program/1/edit" class="btn btn-primary m-r-20">Edit Program</a>
            <a href="/dppa/program" class="btn btn-primary m-r-20">Kembali Ke Halaman Sebelumnya</a>
        </div>
        <h3>Info</h3>
        <ul>
            <li><strong>Kode Program: </strong>{{$data->kode}}</li>
        </ul>
        <div class="clearfix">
            <div class="pull-xs-left">
                <h3>Kegiatan</h3>
            </div>
            <div class="pull-xs-right m-t-20">
                <a href="#" class="btn btn-primary  btn-sm">Tambah Kegiatan</a>
                <a href="#" class="btn btn-primary btn-sm">Impor Kegiatan</a>
                <a href="#" class="btn btn-primary btn-sm">Ekspor Kegiatan</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah Anggaran</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->kegiatan as $kegiatan)
                <tr>
                    <th>{{$kegiatan->kode}}</th>
                    <th><a href="/dppa/program/{{$data->kode}}/kegiatan/{{$kegiatan->kode}}">{{ $kegiatan->nama  }}</a></th>
                    <th>{{ 'Rp '. number_format($kegiatan->jumlah_anggaran)}}</th>
                    <th><a href="#"><i class="wb-edit"></i></a> <a href="#"><i class="wb-trash"></i></a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($data->kegiatan->lastPage() != 1)
            <nav class="pull-xs-right">
                <span class="sr-only">Loading...</span>
                <ul class="pagination">
                    <li class="page-item @if($data->kegiatan->previousPageUrl() == null) disabled @endif">
                        <a class="page-link" href="{{$data->kegiatan->previousPageUrl()}}">
                        <span aria-hidden="true">←</span> Previous </a>
                    </li>
                    <li class="page-item @if(!$data->kegiatan->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{$data->kegiatan->nextPageUrl()}}">Next
                        <span aria-hidden="true">→</span></a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
@endsection

