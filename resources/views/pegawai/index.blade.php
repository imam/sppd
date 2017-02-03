@extends('layouts.app')

@section('content')
    <div id="root">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Pegawai</h2>
            </div>
                <div class="pull-xs-right m-t-30">
                    @if(\Entrust::hasRole(['admin','supervisor']))
                        @if(\Entrust::hasRole('admin'))
                            <a href="{{route('pegawai.import')}}" class="btn btn-primary">Impor Pegawai</a>
                        @endif
                    <a href="{{route('pegawai.create')}}" class="btn btn-primary">Tambah Pegawai</a>
                    @endif
                </div>
        </div>
        <div id="table" class="m-t-20">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <table class="table table-striped" data-plugin="dataTable">
                    <thead>
                    <tr>
                        @each('_table.head',['Nama','NIP','Jabatan','Status','Pangkat','NPWP','Email','Action'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $pegawai)
                        <tr>
                            <td>{{$pegawai->nama}}</td>
                            <td>{{$pegawai->NIP or '-'}}</td>
                            <td>{{$pegawai->jabatan}}</td>
                            <td>
                                @if($pegawai->status=='Nonaktif')
                                    <span style="color:red">Nonaktif</span>
                                @else
                                    {{$pegawai->status}}
                                @endif
                            </td>
                            <td>{{$pegawai->pangkat or '-'}}</td>
                            <td>{{$pegawai->NPWP or '-'}}</td>
                            <td>
                                @if($pegawai->user_id)
                                    {{$pegawai->user->email}}
                                @else
                                    Belum Terdaftar <a href="/pegawai/{{$pegawai->id}}/edit#akun">Daftarkan</a>
                                @endif
                            </td>
                            <th>
                                @if(\Entrust::hasRole(['admin','supervisor']))
                                    <a href="/pegawai/{{$pegawai->id}}/edit"><i class="wb-edit" ></i></a>
                                    <a onclick="deletealert('{{route('pegawai.destroy',['id'=>$pegawai->id])}}')" href="#"><i class="wb-trash"></i></a>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>
@endsection
