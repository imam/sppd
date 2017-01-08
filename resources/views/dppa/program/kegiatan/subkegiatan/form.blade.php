@extends('layouts.app')

@section('content')
    @include('_partials.top-alert',['session_name'=>'data_created','output_text'=>'Data Created'])
    <h2>Tambah Sub Kegiatan</h2>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/dppa/program/{{$program_kode}}/kegiatan/{{$kegiatan_kode}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="/dppa/program/{{$program_kode}}/kegiatan/{{$kegiatan_kode}}/subkegiatan" method="post">
        {{csrf_field()}}
        <input type="hidden" name="kegiatan_id" value="{{\App\DPPA\Kegiatan::where('kode',$kegiatan_kode)->first()->id}}">
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Nama Sub-Kegiatan
                </h4>
                <input type="text" class="form-control" placeholder="Nama Sub-Kegiatan" name="nama" value="{{$sub_kegiatan->nama or null}}">
            </div>
            <div class="col-lg-6">
                <h4>
                    Anggaran
                </h4>
                <input type="text" class="form-control" placeholder="Anggaran" name="jumlah_anggaran" value="{{$sub_kegiatan->jumlah_anggaran or null}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Uraian dan Kode rekening
                </h4>

                <div class="row">
                    <div class="col-lg-8">
                        <select class="form-control uraian_select select2" v-model="edit_uraian" placeholder="Uraian" name="uraian_id" >
                            @foreach($uraian as $singleuraian)
                                <option value="{{$singleuraian->id}}" >
                                    {{$singleuraian->uraian}} - {{$singleuraian->kode_rekening}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4" >
                        <button class="btn btn-default" type="button" data-toggle="modal"
                                :data-target="'#edit_uraian_'+edit_uraian"><i class="wb-wrench"></i></button>
                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#tambah_uraian"><i class="wb-plus"></i></button>
                        <button class="btn btn-default" type="button" onclick="deletealert(content.edit_uraian)"><i class="wb-minus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>
    @foreach($uraian as $singleuraian)
        <!-- Modal -->
        <div class="modal fade" id="edit_uraian_{{$singleuraian->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/dppa/program/{{$program_kode}}/kegiatan/{{$kegiatan_kode}}/uraian/{{$singleuraian->id}}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Edit Uraian</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ref" value="{{Request::url()}}">
                            <input type="hidden" name="_method" value="put">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>
                                        Uraian
                                    </h4>
                                    <input type="text" value="{{$singleuraian->uraian}}" class="form-control" placeholder="Uraian" name="uraian">
                                </div>
                                <div class="col-lg-6">
                                    <h4>
                                        Kode Rekening
                                    </h4>
                                    <input type="text" value="{{$singleuraian->kode_rekening}}" class="form-control" placeholder="Kode Rekening" name="kode_rekening">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal -->
    <div class="modal fade" id="tambah_uraian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="/dppa/program/{{$program_kode}}/kegiatan/{{$kegiatan_kode}}/uraian"  method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Buat Uraian</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="ref" value="{{Request::url()}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>
                                        Uraian
                                    </h4>
                                    <input type="text"  class="form-control" placeholder="Uraian" name="uraian">
                                </div>
                                <div class="col-lg-6">
                                    <h4>
                                        Kode Rekening
                                    </h4>
                                    <input type="text" class="form-control" placeholder="Kode Rekening" name="kode_rekening">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var content = new Vue({
            el: '.page-content',
            data: {
                edit_uraian: '{{$uraian->first()->id}}'
            },
            computed: {

            }
        });
    </script>
    <script>
        function deletealert(kode){
            alertify.confirm("Anda yakin ingin menghapus item ini?",function(e) {
                e.preventDefault();
                $.ajax({
                    method: 'DELETE',
                    url: '/dppa/program/{{$program_kode}}/kegiatan_id/{{$kegiatan_kode}}/uraian/'+kode,
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body:{
                        ref: '{{Request::url()}}'
                    }
                }).done(function(){
                    alertify.alert('success');
                    window.location.reload();
                }).fail(function(){
                    alertify.alert('fail');
                })
            });
        }
    </script>
@endsection