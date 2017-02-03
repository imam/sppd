@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Transaksi Perjalanan Dinas</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('transaksiperjalanandinas.create')}}" class="btn btn-primary " target="_blank">Tambah Transaksi Perjalanan Dinas</a>
            </div>
        </div>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-body">
                <table class="table table-striped" data-plugin="dataTable">
                    <thead>
                    <tr>
                        @each('_table.head',['Nomor Surat Perintah Tugas','Perjalanan','Tanggal','Petugas','Pejabat','Action'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transaksiperjalanandinas as $h)
                        <tr>
                            <td>{{$h->nomor_surat}}</td>
                            <td>{{$h->perjalanan_dinas->maksud_perjalanan}}</td>
                            @php
                            $tb = new \Carbon\Carbon($h->perjalanan_dinas->tanggal_berangkat);
                            @endphp
                            <td>{{$tb->toFormattedDateString()}}</td>
                            <td><a href="#" v-on:click="modal_model_id = {{$h->id}}" data-toggle="modal" data-target="#petugas">Link</a></td>
                            <td><a href="#" v-on:click="modal_model_id = {{$h->id}}" data-toggle="modal" data-target="#pejabat">Link</a></td>
                            <td>
                                <a href="{{route('transaksiperjalanandinas.edit',['id'=>$h->id])}}"><span class="wb wb-wrench"></span></a>
                                <a onclick="deletealert('{{route('transaksiperjalanandinas.destroy',['id'=>$h->id])}}')" href="#"><i class="wb wb-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="petugas" tabindex="-1" role="dialog" v-if="modal_data" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                @each('_table.head',['Nomor Surat','Nama Pegawai'],'text')
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="p in modal_data.petugas">
                                <td>@{{ p.nomor_surat }}</td>
                                <td>@{{ p.pegawai.nama }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="pejabat" tabindex="-1" role="dialog" v-if="modal_data" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pejabat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                @each('_table.head',['NIP','Nama','Jabatan'],'text')
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="p in modal_data.pejabat">
                                <td>@{{ p.nip }}</td>
                                <td>@{{ p.nama }}</td>
                                <td>@{{ p.jabatan }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="/js/deletealert.js"></script>
    <script>
        data = new Vue({
            el:'#content',
            data:{
                modal_model_id:null,
                modal_data: null
            },
            computed:{
                modal_data:function(){
                    if(this.modal_model_id){
                        return transaksiperjalanandinas.filter(function(u){
                            return u.id == this.modal_model_id;
                        }.bind(this))[0]
                    }
                    return null;
                }
            }
        });
    </script>
@endsection
