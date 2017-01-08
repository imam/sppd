@extends('layouts.app')

@section('content')
    @include( '_partials.top-alert',['session_name'=>'data_updated','output_text'=>'Sub Kegiatan Updated'])
    <h2>Edit Sub Kegiatan</h2>
    <div class="m-t-30 m-r-20 m-b-2">
        <a href="{{route('kegiatan_id',['id'=>$sub_kegiatan->kegiatan->kode])}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="{{route('subkegiatan.update',['id'=>$sub_kegiatan->id])}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
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
                <input id="jumlah_anggaran" type="text" class="form-control" placeholder="Anggaran" name="jumlah_anggaran" value="{{$sub_kegiatan->jumlah_anggaran or null}}" data-type="money">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>
                    Uraian
                </h4>
                <input type="text" class="form-control" placeholder="Uraian" name="uraian" value="{{$sub_kegiatan->uraian or null}}">
            </div>
            <div class="col-lg-6">
                <h4>
                    Kode Rekening
                </h4>
                <input type="text" class="form-control" placeholder="Kode Rekening" name="kode_rekening" value="{{$sub_kegiatan->kode_rekening or null}}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary m-t-10">Submit</button>
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection