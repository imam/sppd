@extends('layouts.app')

@section('content')
    <div id="content">
    <h2>Tambah Perjalanan</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('perjalanandinas.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <div class="alert alert-danger" style="text-align:left" v-if="errors">
        <ul>
            <li v-for="error in errors">@{{ error }}</li>
        </ul>
    </div>
    <div class="panel panel-bordered">
        <div class="panel-heading">
            <div class="panel-title">Kegiatan</div>
        </div>
        <div class="panel-body">
            <select2 data-placeholder="Pilih Kegiatan" v-model="kegiatan_id">
                <option value=""></option>
                @foreach($kegiatan as $k)
                    <option value="{{$k->id}}">{{$k->nama}}</option>
                @endforeach
            </select2>
        </div>
    </div>
    <div class="panel panel-bordered" >
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
            <div v-if="show_sub_kegiatan">
                <div>
                    <select2 data-placeholder="Pilih Sub Kegiatan" v-model="sub_kegiatan_id">
                        <option value=""></option>
                        <option v-for="sk in kegiatan.sub_kegiatan" :value="sk.id">@{{sk.nama}}</option>
                    </select2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Lokasi dan Waktu</div>
                </div>
                <div class="panel-body">
                    <h5>Tempat Berangkat</h5>
                    <input_text v-model="tempat_berangkat" placeholder="Tempat Berangkat"></input_text>
                    <h5>Tempat Tujuan</h5>
                    <input_text v-model="tempat_tujuan" placeholder="Tempat Tujuan"></input_text>
                    <div class="row input-daterange m-t-10 text-xs-left" data-plugin="datepicker" data-start-date="now">
                        <div class="col-lg-6">
                            <h5>Tanggal Berangkat</h5>
                            <input_text v-model="tanggal_berangkat" placeholder="Tanggal Berangkat"></input_text>
                        </div>
                        <div class="col-lg-6">
                            <h5>Tanggal Pulang</h5>
                            <input_text v-model="tanggal_pulang" placeholder="Tanggal Pulang"></input_text>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Referensi</div>
                </div>
                <div class="panel-body">
                    <h5>Referensi Perjalanan <em>Opsional</em></h5>
                    <input_text v-model="referensi_perjalanan" placeholder="Referensi Perjalanan"></input_text>
                    <h5>Nomor Referensi <em>Opsional</em></h5>
                    <input_text v-model="nomor_referensi" placeholder="Nomor Referensi"></input_text>
                    <h5>Tanggal Referensi <em>Opsional</em></h5>
                    <datepicker v-model="tanggal_referensi" placeholder="Tanggal Referensi">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Detil Kegiatan</div>
                </div>
                <div class="panel-body">
                    <h5>Jenis Perjalanan</h5>
                    <select2 v-model="jenis_perjalanan" data-placeholder="Jenis Perjalanan">
                        <option value="undangan">Perjalanan Undangan</option>
                        <option value="terjadwal">Perjalanan Terjadwal</option>
                    </select2>
                    <h5>Tingkat Biaya Perjalanan Dinas</h5>
                    <select2 data-placeholder="Tingkat Biaya Perjalanan Dinas" v-model="tingkat_biaya_perjalanan_dinas">
                        <option value="A">[A] Untuk Menteri, Wakil Menteri, Pejabat Eselon I, serta Pejabat lainnya yang setara.</option>
                        <option value="B">[B] Untuk Pejabat Negara lainnya, Pejabat Eselon II, dan Pejabat Lainnya yang setara.</option>
                        <option value="C">[C] Untuk Pejabat Eselon III/PNS Golong IV, Pejabat Eselon IV/PNS Golongan III, PNS Golongan II dan I.</option>
                    </select2>
                    <h5>Maksud Perjalanan</h5>
                    <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Maksud Perjalanan" v-model="maksud_perjalanan"></textarea>
                    <h5>Alat Angkutan yang Digunakan <em>Opsional</em></h5>
                    <input_text  v-model="alat_angkutan_yang_digunakan" placeholder="Alat Angkutan Yang Digunakan"></input_text>
                    <h5>Keterangan Lain-Lain <em>Opsional</em></h5>
                    <textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Keterangan Lain-Lain" v-model="keterangan_lain_lain"></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-title">Persetujuan</div>
                </div>
                <div class="panel-body">
                    <h5>Pejabat Pelaksana Teknis Kegiatan</h5>
                    <select2 data-placeholder="Pejabat Pelaksana Teknis Kegiatan" v-model="pejabat_pelaksana_teknis_kegiatan">
                        @foreach($pegawai as $p)
                            <option value="{{$p->id}}">{{$p->nama}}</option>
                        @endforeach
                    </select2>
                    <h5>Pejabat Pengadaan Barang dan Jasa  <em>Opsional</em></h5>
                    <select2 data-placeholder="Pejabat Pengadaan Barang dan Jasa" v-model="pejabat_pengadaan_barang_dan_jasa">
                        @foreach($pegawai as $p)
                            <option value="{{$p->id}}">{{$p->nama}}</option>
                        @endforeach
                    </select2>
                    <h5>Pejabat Kuasa Pengguna Anggaran</h5>
                    <select2 data-placeholder="Pejabat Kuasa Pengguna Anggaran" v-model="pejabat_kuasa_pengguna_anggaran">
                        @foreach($pegawai as $p)
                            <option value="{{$p->id}}">{{$p->nama}}</option>
                        @endforeach
                    </select2>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <button type="submit" v-on:click="submit()" class="pull-xs-right btn btn-primary m-t-10" :class="{'disabled':submitting}"><i class="fa fa-spinner fa-spin fa-fw" v-if="submitting"></i>  Submit</button>
    </div>

    </div>
@endsection

@section('script')

    <script>
        var kepo;
        data = new Vue({
            el: '#content',
            data:{
                kegiatan: [],
                current_selected_sub_kegiatan: null,
                current_selected_kegiatan: null,
                request: null,
                jenis_perjalanan: null,
                kegiatan_loading: false,
                show_sub_kegiatan: false,
                sub_kegiatan_id: null,
                request: [],
                kegiatan_id: null,
                tempat_berangkat: null,
                submitting: false,
                tempat_tujuan: null,
                tanggal_berangkat: null,
                tanggal_pulang: null,
                referensi_perjalanan: null,
                nomor_referensi: null,
                alat_angkutan_yang_digunakan: null,
                tanggal_referensi: null,
                tingkat_biaya_perjalanan_dinas: null,
                maksud_perjalanan: null,
                keterangan_lain_lain:null,
                pejabat_pelaksana_teknis_kegiatan:null,
                pejabat_pengadaan_barang_dan_jasa:null,
                pejabat_kuasa_pengguna_anggaran:null,
                errors: null
            },
            computed:{
                show_sub_kegiatan:function(){
                    if(this.kegiatan.length == 0 ){
                        return false;
                    }else{
                        return true;
                    }
                },
                request: function(){
                    return this.$data;
                }
            },
            watch:{
                kegiatan_id: function(){
                    this.kegiatan = [];
                    this.kegiatan_loading = true;
                    if(this.kegiatan_id){
                        console.log('halo');
                        axios.get('/api/kegiatan/'+this.kegiatan_id)
                                .then(function(response){
                                    data.kegiatan = response.data.dppa_kegiatan;
                                    console.log(response);
                                    data.kegiatan_loading = false;
                            })
                    }
                }
            },
            methods:{
                submit:function(){
                    this.submitting = true;
                    data.errors = null;
                    axios.post('/perjalanandinas',this.request)
                            .then( function(response){
                                notie.alert('success','Success',3);
                                console.log(response);
                                data.submitting = false;
                                window.location.reload();
                            })
                            .catch(function(response){
                                notie.alert('error','Error');
                                kepo = response;
                                data.submitting = false;
                                data.errors = kepo.response.data;
                            })
                }
            }
        });
    </script>
@endsection
