@extends('layouts.app')

@section('content')
    @include('_partials.top-alert',['session_name'=>'data_created','output_text'=>'Data created'])
    @if (count($errors) > 0)
        <div class="alert alert-danger" style="text-align:left">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('pembayaran.store')}}" method="post">

    {{csrf_field()}}
    <div id="content">
        <h2>Tambah Pembayaran</h2>
        <div class="m-t-30 m-r-20 m-b-20">
                <a href="{{route('pembayaran.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Kegiatan</div>
            </div>
            <div class="panel-body">
                <select2 placeholder="Kegiatan" v-model="kegiatan_id" name="kegiatan_id">
                    <option :value="k.id"  v-for="k in all_kegiatan">@{{ k.nama }}</option>
                </select2>
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Sub Kegiatan</div>
            </div>
            <div class="panel-body">
                <div v-if="kegiatan.length == 0 && !kegiatan_loading">
                    <p>Harap Pilih Kegiatan Terlebih Dahulu</p>
                </div>
                <div v-if="kegiatan_loading">
                    <i class="fa fa-spinner fa-spin fa-fw"></i>Loading data...
                </div>
                <div v-if="kegiatan.length != 0">
                    <div>
                        <select2 data-placeholder="Pilih Sub Kegiatan" v-model="sub_kegiatan_id" name="sub_kegiatan_id">
                            <option v-for="sk in kegiatan.sub_kegiatan" :value="sk.id">@{{sk.nama}}</option>
                        </select2>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Perjalanan Dinas</div>
            </div>
            <div class="panel-body">
                <div v-if="!kegiatan_id">
                    <p>Harap Pilih Kegiatan Terlebih Dahulu</p>
                </div>
                <div v-if="!sub_kegiatan_id && kegiatan_id">
                    <p>Harap Pilih Sub Kegiatan Terlebih Dahulu</p>
                </div>
                <div v-if="kegiatan.length != 0 && sub_kegiatan_id">
                    <div>
                        <select2 data-placeholder="Pilih Perjalanan Dinas" v-model="perjalanan_dinas_id" name="perjalanan_dinas_id">
                            <option v-for="p in sub_kegiatan.perjalanan_dinas" :value="p.id">@{{p.maksud_perjalanan}}</option>
                        </select2>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Informasi</div>
            </div>
            <div class="panel-body">
                <div v-if="!kegiatan_id">
                    <p>Harap Pilih Kegiatan Terlebih Dahulu</p>
                </div>
                <div v-if="!sub_kegiatan_id && kegiatan_id">
                    <p>Harap Pilih Sub Kegiatan Terlebih Dahulu</p>
                </div>
                <div class="row" v-if="kegiatan.length != 0 && sub_kegiatan_id">
                    <div class="col-lg-4">
                        <p><strong>Jumlah DPA: @{{ kegiatan.jumlah_anggaran |money}}</strong></p>
                    </div>
                    <div class="col-lg-4"><p><strong>Pagu Rekening: @{{ sub_kegiatan.jumlah_anggaran | money}}</strong></p></div>
                    <div class="col-lg-4"><p><strong>Dana Tersedia: @{{ sub_kegiatan.dana_tersedia | money}}</strong></p></div>
                </div>
            </div>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Petugas</div>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    @each('_table.head',['Nama Petugas','Uang Harian','Transport','Penginapan','Action'],'text')
                    </thead>
                    <tbody>
                    <tr v-for="(p,key) in petugas">
                        <td>
                            <select2 data-placeholder="Nama Petugas" v-model="p.pegawai_id" :name="'petugas['+key+'][pegawai_id]'">
                                <option v-for="peg in pegawai" :value="peg.id">@{{ peg.nama }}</option>
                            </select2>
                        </td>
                        <td>
                            <input_text placeholder="Uang Harian" v-model="p.uang" :name="'petugas['+key+'][uang]'"></input_text>
                        </td>
                        <td>
                            <input_text placeholder="Transport" v-model="p.transport" :name="'petugas['+key+'][transport]'"></input_text>
                        </td>
                        <td>
                            <input_text placeholder="Penginapan" v-model="p.penginapan" :name="'petugas['+key+'][penginapan]'"></input_text>
                        </td>
                        <td>
                            <a href="#" v-on:click="$event.preventDefault();petugas.splice(key,1)"><i class="wb-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="btn btn-primary btn-block" v-on:click="petugas.push({})"><div class="fa fa-plus"></div> Tambah Petugas</div>
            </div>
        </div>
        <div class="clearfix">
            <div class="pull-xs-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('script')
    <script>
        data = new Vue({
            el: '#content',
            data: {
                petugas:[{}],
                pegawai: pegawai,
                all_kegiatan: kegiatan,
                kegiatan: [],
                kegiatan_id: null,
                kegiatan_loading: false,
                sub_kegiatan_id: null,
                perjalanan_dinas_id: null,
                petugas: [{}],
                pejabat: [{}],
                ketua_perjalanan_id: null,
                petugas_id: [],
                first_kegiatan_received: true
            },
            mounted:function(){
                if(oldinput){
                    this.kegiatan_id = oldinput.kegiatan_id;
                    this.perjalanan_dinas_id = oldinput.perjalanan_dinas_id;
                    this.petugas = oldinput.petugas;
                }
            },
            watch:{
                kegiatan_id: function(){
                    this.kegiatan = [];
                    this.kegiatan_loading = true;
                    this.sub_kegiatan_id = null;
                    if(this.kegiatan_id){
                        console.log('halo');
                        axios.get('/api/kegiatan/'+data.kegiatan_id)
                                .then(function(response){
                                    if(this.first_kegiatan_received && oldinput){
                                        this.sub_kegiatan_id = oldinput.sub_kegiatan_id;
                                        this.first_kegiatan_received = false;
                                    }
                                    data.kegiatan = response.data.dppa_kegiatan;
                                    console.log(response);
                                    data.kegiatan_loading = false;
                            }.bind(this))
                    }
                },
                sub_kegiatan_id:function(){
                    if(this.kegiatan_id && this.sub_kegiatan_id){
                        this.sub_kegiatan = this.kegiatan.sub_kegiatan.filter(function(sk){return sk.id == this.sub_kegiatan_id}.bind(this))[0];
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
