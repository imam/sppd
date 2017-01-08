@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/global/vendor/dropify/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::get('import_success'))
        <div class="alert dark alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            Data imported
        </div>
    @endif
    <h2>Impor Program</h2>
    <div class="m-t-30 m-r-20 m-b-20">
            <a href="/dppa" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
    </div>
    <div class="pull-xs-left">
    </div>
    <form action="/dppa/import" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" class="dropify" name="file"/>
        <button type="submit" class="btn btn-primary m-t-10 ">Impor</button>
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="/global/vendor/dropify/dropify.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        })
    </script>
@endsection