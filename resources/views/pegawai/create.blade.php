@extends('layouts.app')

@section('content')
    <div id="content">
        @if(Session::get('data_created') ===true)
            <div class="alert dark alert-primary alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                Data created
            </div>
        @endif
        <h2>Tambah Pegawai</h2>
        <div class="m-t-30 m-r-20 m-b-20">
            <a href="/pegawai" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
        </div>
        <form action="/pegawai" method="post">
            {{csrf_field()}}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Nama</div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{old('nama',null)}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">NIP <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="NIP" name="nip" value="{{old('nip',null)}}">
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Jabatan</div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="{{old('jabatan',null)}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Status</div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Status" name="status" value="{{old('status',null)}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Pangkat <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Pangkat" name="pangkat" value="{{old('pangkat',null)}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">NPWP <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="NPWP" name="npwp" value="{{ old('npwp',null) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Akun <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email',null) }}">
                            <input type="password" class="form-control m-t-20" placeholder="Password" name="password" value="{{ old('password',null) }}">
                            <div class="m-t-20">
                                <select2 name="role" class="m-t-20" data-placeholder="Role">
                                    <option value="admin">Administrator</option>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="staff">Staff</option>
                                </select2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix ">
                <button type="submit" class="btn btn-primary m-t-10 pull-xs-right">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        data = new Vue({
            el: '#content'
        })
    </script>
@endsection