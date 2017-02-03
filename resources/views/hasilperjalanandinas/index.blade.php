@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Hasil Perjalanan Dinas</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('hasilperjalanandinas.create')}}" class="btn btn-primary ">Tambah Hasil Perjalanan Dinas</a>
            </div>
        </div>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-body">
                <table class="table table-striped" data-plugin="dataTable">
                    <thead>
                    <tr>
                        @each('_table.head',['Kegiatan','Sub Kegiatan','Maksud','Hasil','File','Action'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hasilperjalanandinas as $h)
                    <tr>
                        <td>{{$h->perjalanan_dinas->kegiatan->nama}}</td>
                        <td>{{$h->perjalanan_dinas->sub_kegiatan->nama}}</td>
                        <td>{{$h->perjalanan_dinas->maksud_perjalanan}}</td>
                        <td   ><a href="#" data-toggle="modal" data-target="#maksud_perjalanan_{{$h->id}}">Link</a></td>
                        @if($h->file)
                            <td><a href="{{route('hasilperjalanandinas.download',['id'=>$h->id])}}">Download</a></td>
                        @else
                            <td>Tidak Ada File</td>
                        @endif
                        <td>
                            <a href="{{route('hasilperjalanandinas.edit',['id'=>$h->id])}}"><i class="wb wb-wrench"></i></a>
                            <a href="#" onclick="deletealert('{{route('hasilperjalanandinas.destroy',['id'=>$h->id])}}')"><i class="wb wb-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="maksud_perjalanan_{{$h->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hasil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!!  $h->hasil!!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>
@endsection