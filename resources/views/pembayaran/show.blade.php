@extends('layouts.app')

@section('content')
    <div id="content">
        <h2>Pembayaran</h2>
        <a href="{{route('pembayaran.index')}}" class="btn btn-primary">Kembali Ke Halaman Sebelumnya</a>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-heading">
                <div class="panel-title">Info</div>
            </div>
            <div class="panel-body">
                <h5>Perjalanan Dinas:</h5>
                <a href="{{route('perjalanandinas.show',['id'=>$pembayaran->perjalanan_dinas->id])}}" target="_blank">
                    Link menuju perjalanan dinas
                </a>
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
                        @each('_table.head',['Nama Pegawai','Link Menuju Pegawai','Uang Harian','Transport','Penginapan'],'text')
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="p in pembayaran.petugas_pembayaran">
                        <td>@{{ p.pegawai.nama }}</td>
                        <td><a :href="'/pegawai/'+p.pegawai.id">Link</a></td>
                        <td>@{{ p.uang | money }}</td>
                        <td>@{{ p.transport | money }}</td>
                        <td>@{{ p.penginapan | money }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        data = new Vue({
            el: '#content',
            data: {
                pembayaran: pembayaran
            },
            filters:{
                money:function(value){
                    return accounting.formatMoney(value);
                }
            }
        });
    </script>
@endsection