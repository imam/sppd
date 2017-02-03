@extends('layouts.app')

@section('content')
    <h3>{{$hasilperjalanandinas->perjalanan_dinas->maksud_perjalanan}}</h3>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('hasilperjalanandinas.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
        </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <div class="panel-title">Info</div>
        </div>
        <div class="panel-body">
            <h5>Ketua Perjalanan Dinas:</h5>
            <p>{{$hasilperjalanandinas->ketua_perjalanan->nama}}</p>
            <h5>Perjalanan Dinas:</h5>
            <p>{{$hasilperjalanandinas->maksud}}</p>
        </div>
    </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <div class="panel-title">Petugas</div>
        </div>
        <div class="panel-body">
            <table class="table table-striped" data-plugin="dataTable">
                <thead>
                <tr>
                    @each('_table.head',['Nomor Surat','Nama Pegawai'],'text')
                </tr>
                </thead>
                <tbody>
                @foreach($hasilperjalanandinas->petugas as $h)
                    <tr>
                        <td>{{$h->nomor_surat}}</td>
                        <td>{{$h->pegawai->nama}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <div class="panel-title">Pejabat</div>
        </div>
        <div class="panel-body">
            <table class="table table-striped" data-plugin="dataTable">
                <thead>
                <tr>
                    @each('_table.head',['NIP','Nama Pejabat','Jabatan'],'text')
                </tr>
                </thead>
                <tbody>
                @foreach($hasilperjalanandinas->pejabat as $h)
                    <tr>
                        <td>{{$h->nip}}</td>
                        <td>{{$h->nama}}</td>
                        <td>{{$h->jabatan}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection