@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/global/vendor/dropify/dropify.min.css">
@endsection

@section('content')

    <h2>Ekspor Program</h2>
    <p>Untuk mengekspor program membutuhkan waktu dikarenakan seluruh data harus diproses terlebih dahulu oleh server.
        Harap bersabar.</p>
    <div class="m-t-30 m-r-20 m-b-20">
        <a href="/dppa/program" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <form action="/dppa/program/export" method="post">
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary m-t-10 ">Export</button>
    </form>
@endsection
