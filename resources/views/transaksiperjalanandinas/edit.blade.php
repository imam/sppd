@extends('layouts.app')

@section('content')
    @include('_partials.top-alert',['session_name'=>'data_updated','output_text'=>'Data updated'])
    @if (count($errors) > 0)
        <div class="alert alert-danger" style="text-align:left">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/transaksiperjalanandinas/{{$current->id}}" method="post" xmlns:v-on="http://www.w3.org/1999/xhtml">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <div id="content">
            <h2>Tambah Transaksi Perjalanan Dinas</h2>
            <div class="m-t-30 m-r-20 m-b-20">
                <a href="{{route('transaksiperjalanandinas.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
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
                            <select2 data-placeholder="Pilih Sub Kegiatan" v-model="perjalanan_dinas_id" name="perjalanan_dinas_id">
                                <option v-for="sk in kegiatan.sub_kegiatan.filter(function(sk){return sk.id == sub_kegiatan_id})[0].perjalanan_dinas" :value="sk.id">@{{sk.maksud_perjalanan}}</option>
                            </select2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Administrasi</div>
                </div>
                <div class="panel-body">
                    <h5>Nomor Surat Perintah Tugas</h5>
                    <input_text placeholder="Nomor Surat Perintah Tugas" name="nomor_surat" value="{{!is_null(old('nomor_surat'))?old('nomor_surat'):$current->nomor_surat}}"></input_text>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Petugas</div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            @each('_table.head',['Nomor Surat Perjalanan Dinas','Nama Petugas','Ketua','Action'],'text')
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(p,key) in petugas">
                            <td><input_text :name="'petugas['+key+'][nomor_surat]'" v-model="p.nomor_surat" placeholder="Nomor Surat"></input_text></td>
                            <td>
                                <select2 :name="'petugas['+key+'][pegawai_id]'" v-model="petugas_id[key]" data-placeholder="Nama Petugas">
                                    <option v-for="peg in pegawai" :value="peg.id">@{{ peg.nama }}</option>
                                </select2>
                            </td>
                            <td>
                                <label class="custom-control custom-radio">
                                    <input :value="petugas_id[key]" name="ketua_perjalanan_id" id="radio1" name="radio" v-model="ketua_perjalanan_id" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Ketua?</span>
                                </label>
                            </td>
                            <td><a href="#" v-on:click="$event.preventDefault();petugas.splice(key,1)"><div class="wb wb-trash"></div></a></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="btn btn-primary btn-block" v-on:click="petugas.push({})"><div class="fa fa-plus"></div> Tambah Petugas</div>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Pejabat Berwenang di Tempat Tujuan</div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            @each('_table.head',['NIP','Nama','Jabatan','Action'],'text')
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(p,key) in pejabat">
                            <td><input_text placeholder="NIP" v-model="p.nip" :name="'pejabat['+key+'][nip]'"></input_text></td>
                            <td><input_text placeholder="Nama" v-model="p.nama" :name="'pejabat['+key+'][nama]'"></input_text></td>
                            <td><input_text placeholder="Jabatan" v-model="p.jabatan" :name="'pejabat['+key+'][jabatan]'"></input_text></td>
                            <td><a href="#" v-on:click="$event.preventDefault();pejabat.splice(key,1)"><span class="wb wb-trash"></span></a></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="btn btn-primary btn-block" v-on:click="pejabat.push({})"><div class="fa fa-plus"></div> Tambah Pejabat</div>
                </div>
            </div>
            <div class="clearfix">
                <div class="pull-xs-right">
                    <button class="btn btn-primary m-t-30" type="submit">Submit</button>
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
                all_kegiatan: kegiatan,
                kegiatan: [],
                kegiatan_id: null,
                kegiatan_loading: false,
                sub_kegiatan_id: null,
                perjalanan_dinas_id: null,
                pegawai: pegawai,
                petugas: null,
                pejabat: null,
                ketua_perjalanan_id: null,
                petugas_id: []
            },
            mounted:function(){
                if(oldinput){
                    formvalue = oldinput;
                }else{
                    formvalue = current;
                }
                this.kegiatan_id = formvalue.kegiatan_id;
                this.$nextTick(function(){
                    this.sub_kegiatan_id = formvalue.sub_kegiatan_id;
                }.bind(this));
                this.petugas_id = formvalue.petugas.map(function(c){return c.pegawai_id})
                this.ketua_perjalanan_id = formvalue.ketua_perjalanan_id;
                this.perjalanan_dinas_id = formvalue.perjalanan_dinas_id;
                this.petugas= formvalue.petugas;
                this.pejabat= formvalue.pejabat;
            },
            watch:{
                kegiatan_id: function(){
                    this.kegiatan = [];
                    this.kegiatan_loading = true;
                    this.sub_kegiatan_id = null;
                    if(this.kegiatan_id){
                        console.log('halo');
                        axios.get('/api/kegiatan/'+this.kegiatan_id)
                                .then(function(response){
                                    this.kegiatan = response.data.dppa_kegiatan;
                                    console.log(response);
                                    this.kegiatan_loading = false;
                                }.bind(this))
                    }
                }
            },
        })
    </script>
@endsection