@extends('layouts.app')

@section('content')
    <div id="root">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Program</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="/dppa/program/create" class="btn btn-primary ">Tambah Program</a>
                <a href="/dppa/program/import" class="btn btn-primary">Impor Program</a>
            </div>
        </div>
        <div id="table" >
            <table class="table table-striped" >
                <thead>
                <tr>
                    @each('_table.head',['Kode Program','Nama Program','Action'],'text')
                </tr>
                </thead>
                <tbody>
                @foreach($data as $program)
                    <tr>
                        <td>{{$program->kode}}</td>
                        <td><a href="/dppa/program/{{$program->kode}}">{{$program->nama}}</a></td>
                        <td><a href="/dppa/program/{{$program->kode}}/edit"><i class="wb-edit"></i></a> <a href="#" onclick="deletealert('{{$program->kode}}')"><i class="wb-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('_table.pagination',['data'=>$data])
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table').DataTable();

        });
    </script>
@endsection
