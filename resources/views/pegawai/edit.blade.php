@extends('layouts.app')

@section('content')
    <div id="content">
        @include('_notification',['session_name'=>'data_updated','text'=>'Pegawai Updated'])
        <h2>Tambah Pegawai</h2>
        <div class="m-t-30 m-r-20 m-b-20">
            <a href="/pegawai/" class="btn btn-primary ">Kembali Ke Halaman Sebelumnya</a>
        </div>
        <form action="/pegawai/{{$pegawai->id}}" method="post">
            <input type="hidden" name="_method" value="put">
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
                            <input value="{{old('nama',$pegawai->nama)}}" type="text" class="form-control" placeholder="Nama" name="nama">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">NIP <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input value="{{old('nip',$pegawai->NIP)}}" type="text" class="form-control" placeholder="NIP" name="nip">
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
                            <input value="{{old('jabatan',$pegawai->jabatan)}}"type="text" class="form-control" placeholder="Jabatan" name="jabatan">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Status</div>
                        </div>
                        <div class="panel-body">
                            <input v-model="status" type="text" class="form-control" placeholder="Status" name="status">
                            <button type="button" class="btn btn-primary m-t-20" v-on:click="status = 'Nonaktif'">Nonaktifkan Pegawai</button>
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
                            <input value="{{old('pangkat',$pegawai->pangkat)}}" type="text" class="form-control" placeholder="Pangkat" name="pangkat">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">NPWP <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input value="{{old('npwp',$pegawai->NPWP)}}"type="text" class="form-control" placeholder="NPWP" name="npwp">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6" id="akun">
                    <div class="panel panel-bordered">
                        <div class="panel-heading">
                            <div class="panel-title">Akun <em class="h6">Opsional</em></div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email',$pegawai->user_id?$pegawai->user->email:null) }}">
                            <input type="password" class="form-control m-t-20" placeholder="{{$pegawai->user?'Password (Abaikan jika tidak ingin diubah)':'Password'}}" name="password" value="{{ old('password',null) }}">
                            <div class="m-t-20">
                                <select2 name="role" :value="pegawai_role" class="m-t-20" data-placeholder="Role">
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
            el: '#content',
            data: {
                pegawai: pegawai,
                pegawai_role: function(){
                    if(pegawai.user){
                        return pegawai.user.roles[0].name;
                    }else{
                        return null;
                    }
                },
                status: old?old.status:pegawai.status
            }
        })
    </script>
@endsection