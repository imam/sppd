@extends('layouts.app')

@section('content')
    <div id="root">
    <div class="clearfix">
        <div class="pull-xs-left">
            <h2>Program</h2>
        </div>
        <div class="pull-xs-right m-t-30">
            <a href="#" class="btn btn-primary ">Tambah Program</a>
            <a href="/dppa/program/import" class="btn btn-primary">Impor Program</a>
            <a href="#" class="btn btn-primary">Ekspor Program</a>
        </div>
    </div>
    <div id="table" >
        <table class="table table-striped" >
            <thead>
            <tr>
                <th>Kode Program</th>
                <th>Nama Program</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($data as $program)
                    <tr>
                        <td>{{$program->kode}}</td>
                        <td><a href="/dppa/program/{{$program->kode}}">{{$program->nama}}</a></td>
                        <th><a href="#"><i class="wb-edit"></i></a> <a href="#"><i class="wb-trash"></i></a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($data->lastPage() != 1)
            <nav class="pull-xs-right">
                <span class="sr-only">Loading...</span>
                <ul class="pagination">
                    <li class="page-item @if($data->previousPageUrl() == null) disabled @endif">
                        <a class="page-link" href="{{$data->previousPageUrl()}}">
                        <span aria-hidden="true">←</span> Previous </a>
                    </li>
                    <li class="page-item @if(!$data->hasMorePages()) disabled @endif">
                        <a class="page-link" href="{{$data->nextPageUrl()}}">Next
                        <span aria-hidden="true">→</span></a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
    </div>
@endsection
