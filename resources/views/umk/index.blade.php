@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>UMK</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('umk.create')}}" class="btn btn-primary">Buat UMK</a>
            </div>
        </div>
        <div>
        </div>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-body">
                <table class="table table-striped" data-plugin="dataTable">
                    <thead>
                    <tr>
                        @each('_table.head',['ID','Nomor','Kegiatan','Rekening Pengajuan','Persetujuan','Action'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($umk as $single)
                        <tr>
                            <td>{{$single->id}}</td>
                            <td>{{$single->id}}/UMK/{{$single->created_at->day}}/{{$single->created_at->month}}
                                /{{$single->created_at->year}}</td>
                            <td>{{$single->kegiatan->nama}}</td>
                            <td><a href="#" v-on:click="modal_model_id = '{{$single->id}}'" data-toggle="modal"
                                   data-target="#rekening_pengajuan">Link</a></td>
                            <td><a href="#" v-on:click="modal_model_id = '{{$single->id}}'" data-toggle="modal"
                                   data-target="#persetujuan">Link</a></td>
                            <td>
                                <a href="{{route('umk.edit',['id'=>$single->id])}}"><i class="wb-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" v-if="modal_model_id" id="rekening_pengajuan" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rekening Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                @each('_table.head',['Sub_kegiatan','Uraian','Jumlah'],'text')
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="rp in rekening_pengajuan_modal_data">
                                <td>@{{ rp.sub_kegiatan.nama }}</td>
                                <td>@{{ rp.uraian }}</td>
                                <td>@{{ rp.jumlah }}</td>
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
        <div class="modal fade" v-if="modal_model_id" id="persetujuan" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rekening Pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                @each('_table.head',['Pejabat Pelaksana Teknis Kegiatan','Pejabat Pengadaan Barang dan Jasa','Pejabat Kuasa Pengguna Anggaran'],'text')
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>@{{ persetujuan_modal_data.pejabat_pelaksana_teknis_kegiatan_pegawai.nama }}</td>
                                <td>@{{ persetujuan_modal_data.pejabat_pengadaan_barang_dan_jasa_pegawai.nama }}</td>
                                <td>@{{ persetujuan_modal_data.pejabat_kuasa_pengguna_anggaran_pegawai.nama }}</td>
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
                var data = new Vue({
                    el: '#content',
                    data: {
                        modal_model_id: null,
                        rekening_pengajuan_modal_data: null,
                        persetujuan_modal_data: null
                    },
                    computed: {
                        rekening_pengajuan_modal_data: function () {
                            if (this.modal_model_id) {
                                return umk.filter(function (u) {
                                    return u.id == this.modal_model_id;
                                }.bind(this))[0].rekening_pengajuan
                            } else {
                                return null;
                            }
                        },
                        persetujuan_modal_data: function () {
                            if (this.modal_model_id) {
                                return umk.filter(function (u) {
                                    return u.id == this.modal_model_id;
                                }.bind(this))[0]
                            } else {
                                return null;
                            }
                        }
                    }
                });
            </script>
@endsection