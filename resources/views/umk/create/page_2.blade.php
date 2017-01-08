@extends('layouts.app')

@section('content')
<h2>Buat UMK</h2>
<div class="pearls row m-t-30">
    <div class="pearl done col-xs-4">
        <a href="{{route('umk.create')}}"><span class="pearl-number">1</span></a>
        <span class="pearl-title">Pilih Tahun Anggaran</span>
    </div>
    <div class="pearl current col-xs-4">
        <span class="pearl-number">2</span>
        <span class="pearl-title">Pilih Kegiatan</span>
    </div>
    <div class="pearl col-xs-4">
        <span class="pearl-number">3</span>
        <span class="pearl-title">Masukkan Data</span>
    </div>
</div>
<div>
    <div class="row">
        <form action="{{route('umk.create')}}">
            <input type="hidden" name="tahun_anggaran" value="{{$tahun_anggaran}}">
            <div class="col-lg-10">
                <select name="kegiatan" id="kegiatan" class="form-control" data-plugin="select2" data-placeholder="Pilih Kegiatan">
                    <option value=""></option>
                    @foreach($kegiatan as $single_kegiatan)
                        <option value="{{$single_kegiatan->id}}">{{$single_kegiatan->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection