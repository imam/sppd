@extends('layouts.app')

@section('content')
    <h3>DPPA</h3>
    <div class="panel panel-bordered">
        <div class="panel-body">
            <table id="table" class="table table-hover dataTable table-striped w-full m-t-20">
            <thead>
            <tr>
                @each('_table.head',['Kode','Nama','Action'],'text')
            </tr>
            </thead>
            <tbody>
            @foreach($data as $program)
                <tr>
                    <td>{{$program->kode}}</td>
                    <td><a href="{{route('program.show',['id'=>$program->kode])}}">{{$program->nama}}</a></td>
                    <td>
                        @if($program->editable && Entrust::hasRole(['admin','supervisor']))
                            <a href="/program/{{$program->kode}}/edit"><i class="wb-edit"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table').DataTable({
            });
        });
    </script>
@endsection
