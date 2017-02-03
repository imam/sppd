@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="clearfix">
            <div class="pull-xs-left">
                <h2>Pembayaran</h2>
            </div>
            <div class="pull-xs-right m-t-30">
                <a href="{{route('pembayaran.create')}}" class="btn btn-primary ">Tambah Pembayaran</a>
            </div>
        </div>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-body">
                <table class="table table-striped" data-plugin="dataTable">
                    <thead>
                    <tr>
                        @each('_table.head',['Kegiatan','Perjalanan','Petugas','Tanggal','Action'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pembayaran as $p)
                        <tr>
                            <td>{{$p->perjalanan_dinas->kegiatan->nama}}</td>
                            <td>{{$p->perjalanan_dinas->maksud_perjalanan}}</td>
                            <td><a href="#" data-toggle="modal" data-target="#petugas" v-on:click="modal_model_id = {{$p->id}}">Link</a></td>
                            <td>{{$p->perjalanan_dinas->tanggal_berangkat}}</td>
                            <td>
                                <a href="{{route('pembayaran.edit',['id'=>$p->id])}}"><i class="wb wb-wrench"></i></a>
                                <a href="#" onclick="deletealert('{{route('pembayaran.destroy',['id'=>$p->id])}}')"><i class="wb wb-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" v-if="modal_model_id" id="petugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                @each('_table.head',['Pegawai','Uang Harian','Transport','Penginapan'],'text')
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="p in modal_data.petugas_pembayaran">
                                <td>@{{ p.pegawai.nama }}</td>
                                <td>@{{ p.uang | money }}</td>
                                <td>@{{ p.transport | money }}</td>
                                <td>@{{ p.penginapan | money }}</td>
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
            data: {
                modal_model_id : null
            },
            computed:{
                modal_data: function(){
                    if(this.modal_model_id){
                        return pembayaran.filter(function(u){
                            return u.id == this.modal_model_id
                        }.bind(this))[0];
                    }
                }
            },
            filters:{
                money:function(value){
                    return accounting.formatMoney(value);
                }
            }
        })
    </script>
@endsection