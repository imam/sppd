@extends('layouts.app')

@section('content')
    <div id="root">
    <div class="clearfix">
        <div class="pull-xs-left">
            <h2>program</h2>
        </div>
        <div class="pull-xs-right m-t-30">
            <a href="/dppa/program/create" class="btn btn-primary ">tambah program</a>
            <a href="/dppa/program/import" class="btn btn-primary">impor program</a>
        </div>
    </div>
    <div id="table" >
        <table class="table table-striped" >
            <thead>
            <tr>
                @each('_table.head',['kode program','nama program','action'],'text')
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
        function deletealert(kode){
            alertify.confirm("anda yakin ingin menghapus item ini?",function(e) {
                e.preventdefault();
                $.ajax({
                    method: 'delete',
                    url: '/dppa/program/'+kode,
                    headers:{
                        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function(){
                    alertify.alert('success');
                    window.location.reload();
                }).fail(function(){
                    alertify.alert('fail');
                })
            });
        }
    </script>
@endsection
