@extends('layouts.app')

@section('content')
    <div id="root">
        <h2>Profile</h2>
        <div class="panel panel-bordered m-t-20">
            <div class="panel-heading">
                <div class="panel-title">Edit Profile</div>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="text-align:left">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/profile" method="post">
                    {{csrf_field()}}
                    <h5>Email Anda</h5>
                    <input type="text" value="{{$user->email}}" class="form-control" name="email">
                    <h5>Password</h5>
                    <input type="password" class="form-control" name="password">
                    <h5>Confirm Password</h5>
                    <input type="password" class="form-control" name="confirm">
                    <input type="submit" value="Submit" class="btn btn-primary m-t-20">
                </form>               
            </div>
        </div>
    </div>
@endsection