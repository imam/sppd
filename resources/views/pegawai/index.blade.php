@extends('layouts.app')

@section('content')
    <div id="root">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Pegawai</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('pegawai.import')}}" class="btn btn-primary">Impor Pegawai</a>
                <a href="{{route('pegawai.create')}}" class="btn btn-primary">Tambah Pegawai</a>
            </div>
        </div>
        <div id="table" class="m-t-20">
            <table class="table table-striped" data-plugin="dataTable">
                <thead>
                <tr>
                    @each('_table.head',['Kode','NIP','Jabatan','Status','Pangkat','NPWP','Email','Action'],'text')
                </tr>
                </thead>
                <tbody>
                @foreach($data as $pegawai)
                    <tr>
                        <td>{{$pegawai->nama}}</td>
                        <td>{{$pegawai->NIP or '-'}}</td>
                        <td>{{$pegawai->jabatan}}</td>
                        <td>{{$pegawai->status}}</td>
                        <td>{{$pegawai->pangkat or '-'}}</td>
                        <td>{{$pegawai->NPWP or '-'}}</td>
                        <td>{!!$pegawai->user_id or 'Belum Terdaftar <a href="#">Daftarkan</a>'!!}</td>
                        <th>
                            <a href="/pegawai/{{$pegawai->id}}/edit"><i class="wb-edit"></i></a>
                            <a onclick="deletealert('{{route('pegawai.destroy',['id'=>$pegawai->id])}}')" href="#"><i class="wb-trash"></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/deletealert.js"></script>
@endsection
