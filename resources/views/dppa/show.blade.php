@extends('layouts.app')

@section('content')
    <h3>DPPA</h3>
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
                    <a href="{{route('program.edit',['id'=>$program->kode])}}"><i class="wb-edit"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var table = $('#table').DataTable({
            });
        });
    </script>
@endsection
