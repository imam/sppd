@extends('layouts.app')

@section('content')
    <h2>Tambah Pembayaran</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="{{route('pembayaran.index')}}" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <div class="row">
            <div class="col-lg-4">
                <p><strong>Jumlah DPA:</strong></p>
            </div>
            <div class="col-lg-4"><p><strong>Pagu Rekening:</strong></p></div>
            <div class="col-lg-4"><p><strong>Dana Tersedia:</strong></p></div>
        </div>
    <table class="table table-striped">
        <thead>
        @each('_table.head',['Nama Petugas','Uang Harian','Transport','Penginapan','Action'],'text')
        </thead>
    </table>
@endsection