@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/global/vendor/dropify/dropify.min.css">
@endsection

@section('content')

    @if(Session::get('import_success')=== 'true')
        <div class="alert dark alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            Data imported
        </div>
    @endif
    <h2>Impor Program</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="/dppa/program" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <div class="pull-xs-left">
        <p>Jika anda ingin mengimpor program, pastikan anda mengimpornya dengan file Excel. Template untuk impor data dapat
        diunduh dengan <a href="">mengekspor data program</a></p>
    </div>
    <form action="/api/dppa/program/import" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" class="dropify" name="file"/>
        <button type="submit" class="btn btn-primary m-t-10 ">Impor</button>
    </form>
@endsection

@section('script')
    <script src="/global/vendor/dropify/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection