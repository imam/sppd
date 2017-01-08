@extends('layouts.app')

@section('content')
    <div id="content" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <h2>Buat UMK</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('umk.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
        </div>
    <div>
        <div class="alert dark alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            Error:
            <ul>
                <li>Halo</li>
                <li>Kepo</li>
            </ul>
        </div>
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <div class="panel-title">Kegiatan</div>
            </div>
            <div class="panel-body">
                <select2 placeholder="Pilih Kegiatan" v-model="kegiatan_id">
                    @foreach($kegiatan as $single)
                        <option value="{{$single->id}}">{{$single->nama}}</option>
                    @endforeach
                </select2>
            </div>
        </div>
        <div :class="{'hidden-xs-up':data_loading==false}" class="panel panel-bordered">
            <div class="panel-body">
                <h3><i class="fa fa-spinner fa-spin fa-fw"></i>Loading data...</h3>
            </div>
        </div>
        <div :class="{'hidden-xs-up':sub_kegiatan.length==0}">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Rekening Pengajuan</div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 p-r-20">
                            <h4>Pilih Sub-Kegiatan</h4>
                            <select2  v-model="current_selected_sub_kegiatan" placeholder="Pilih Sub-Kegiatan" >
                                <option :value="single.id" v-for="(single,key) in sub_kegiatan">@{{single.nama}}</option>
                            </select2>
                            <div class="m-t-20" v-if="current_selected_sub_kegiatan!=null">
                                <h4>Uraian</h4>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        @each('_table.head',['Uraian','Jumlah','Action'],'text')
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(single,index) in uraian">
                                        <td>
                                            <input type="text" v-model="uraian[index].uraian" class="form-control" placeholder="Uraian">
                                        </td>
                                        <td>
                                            <input type="text" data-plugin="maskMoney" v-model="uraian[index].jumlah" class="form-control" placeholder="Jumlah">
                                        </td>
                                        <td>
                                            <a href="#" v-on:click="delete_uraian(index,$event)"><i class="wb-trash"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-block btn-info" v-on:click="tambah_uraian"><i class="fa fa-plus"></i> Tambah Uraian</button>
                                <div class="clearfix">
                                    <div class="pull-xs-right">
                                        <button v-on:click="submit_to_rekening_pengajuan" class="btn btn-primary m-t-20" ><i class="fa fa-angle-right"></i> Masukkan Ke Rekening Pengajuan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 p-l-20">
                            <h4>Informasi Anggaran</h4>
                            <p v-if="kegiatan_selected"><strong>Jumlah DPA: </strong>@{{ all_data.jumlah_anggaran | money }}</p>
                            <p v-if="current_selected_sub_kegiatan!=null"><strong>Pagu Rekening:</strong> @{{ current_selected_sub_kegiatan | get_sub_kegiatan('jumlah_anggaran') | money }}</p>
                            <p v-if="current_selected_sub_kegiatan!=null"><strong>Dana Tersedia:</strong></p>
                            <h4 class="m-t-20">Daftar Rekening Pengajuan</h4>
                            <div id="rekening-pengajuan-table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        @each('_table.head',['Sub Kegiatan','Uraian','Jumlah','Action'],'text')
                                    </tr>
                                    </thead>
                                    <tbody >
                                    <tr v-for="(data,key) in daftar_rekening_pengajuan">
                                        <td>@{{ sub_kegiatan[data.sub_kegiatan].nama }}</td>
                                        <td>@{{ data.uraian }}</td>
                                        <td>@{{ data.jumlah | money}}</td>
                                        <td><a href="#" v-on:click="delete_rekening_pengajuan_item(key,$event)"><i class="wb-trash"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Persetujuan</div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="pejabat_pelaksana_teknis_kegiatan">Pejabat Pelaksana Teknis Kegiatan</label>
                            <select2 placeholder="Pejabat Pelaksana Teknis Kegiatan" v-model="pejabat_pelaksana_teknis_kegiatan">
                                @foreach($pegawai as $single)
                                    <option value="{{$single->id}}">{{$single->nama}}</option>
                                @endforeach
                            </select2>
                        </div>
                        <div class="col-lg-4">
                            <label for="pejabat_pengadaan_barang_dan_jasa">Pejabat Pengadaan Barang dan jasa</label>
                            <select2 v-model="pejabat_pengadaan_barang_dan_jasa" placeholder="Pejabat Pengadaan Barang Dan Jasa" v-model="pejabat_pelaksana_teknis_kegiatan">
                                @foreach($pegawai as $single)
                                    <option value="{{$single->id}}">{{$single->nama}}</option>
                                @endforeach
                            </select2>
                        </div>
                        <div class="col-lg-4">
                            <label for="pejabat_kuasa_pengguna_anggaran">Pejabat Kuasa Pengguna Anggaran</label>
                            <select2 placeholder="Pejabat Kuasa Pengguna Anggaran" v-model="pejabat_kuasa_pengguna_anggaran">
                                <option value=""></option>
                                @foreach($pegawai as $single)
                                    <option value="{{$single->id}}">{{$single->nama}}</option>
                                @endforeach
                            </select2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="pull-xs-right">
                    <button class="btn btn-primary m-t-30" :class="{'disabled':submit_on_progress}" v-on:click="submit">
                        <i class="fa fa-spinner fa-spin fa-fw" v-if="submit_on_progress"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script type="text/x-template" id="select2-template">
        <select class="form-control" data-plugin="select2"
                :data-placeholder="placeholder">
            <option value=""></option>
            <slot></slot>
        </select>
    </script>
    <script>
        var kepo;
        data = new Vue({
            el: "#content",
            data: {
                kegiatan_selected: false,
                kegiatan_id: null,
                sub_kegiatan: [],
                uraian: [],
                data_loading: false,
                daftar_rekening_pengajuan: [],
                current_selected_sub_kegiatan: null,
                all_data: null,
                pejabat_pelaksana_teknis_kegiatan_id: null,
                pejabat_pengadaan_barang_dan_jasa_id:null,
                pejabat_kuasa_pengguna_anggaran_id: null,
                submit_on_progress: false
            },
            watch:{
                kegiatan_id: function(val){
                    if(val!=null){
                        data.sub_kegiatan = [];
                        data.daftar_rekening_pengajuan = [];
                        data.data_loading = true;
                        data.current_selected_sub_kegiatan = null;
                        axios.get('/api/kegiatan_id/'+val)
                            .then(function(response){
                                console.log(response.data);
                                data.data_loading =false;
                                data.all_data = response.data.dppa_kegiatan;
                                data.sub_kegiatan =response.data.dppa_kegiatan.sub_kegiatan;
                                data.kegiatan_selected = true;
                                data.$nextTick(function(){
                                    $('[data-plugin=select2]').select2();
                                });
                        });
                    }
                }
            },
            computed:{
                request:function(){
                    request = {};
                    request.kegiatan_id = this.kegiatan_id;
                    request.rekening_pengajuan = this.daftar_rekening_pengajuan;
                    request.pejabat_pelaksana_teknis_kegiatan_id = this.pejabat_pelaksana_teknis_kegiatan_id;
                    request.pejabat_pengadaan_barang_dan_jasa_id = this.pejabat_pengadaan_barang_dan_jasa_id;
                    request.pejabat_kuasa_pengguna_anggaran_id = this. pejabat_kuasa_pengguna_anggaran_id;
                    return request;
                }
            },
            methods:{
                tambah_uraian:function(){
                    this.uraian.push({uraian:'',jumlah:'',sub_kegiatan:this.current_selected_sub_kegiatan});
                },
                delete_uraian:function(index,e){
                    e.preventDefault();
                    this.uraian.splice(index,1);
                },
                submit_to_rekening_pengajuan:function(e){
                    e.preventDefault();
                    uraian = this.uraian;
                    uraian.map(function(u){
                        u.jumlah = data.number_only(u.jumlah);
                        return u;
                    });
                    this.daftar_rekening_pengajuan.push(...uraian);
                    this.uraian = [];
                },
                find_sub_kegiatn:function(id){
                },
                delete_rekening_pengajuan_item:function(index, e){
                    e.preventDefault();
                    this.daftar_rekening_pengajuan.splice(index,1);
                },
                number_only:function(value){
                    return value.replace(/[^0-9]/g,'');
                },
                submit:function(){
                    this.submit_on_progress = true;
                    axios.post('/umk', data.request).then(function(response){
                        notie.alert('success','Success',3)
                        console.log(response);
                        kepo = response;
                        data.submit_on_progress = false;
                    }).catch(function(){
                        notie.alert('error','Error')
                    })
                }
            },
            filters:{
                money:function(value){
                    return accounting.formatMoney(value);
                },
                number_only:function(value){
                    return value.replace(/[^0-9]/g,'');
                },
                get_sub_kegiatan:function(value, attribute){
                    console.log(data.sub_kegiatan);
                    return data.sub_kegiatan.filter(function(s){return value == s.id})[0][attribute]
                }
            }
        });
    </script>
@endsection