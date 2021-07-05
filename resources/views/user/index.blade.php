@extends('layouts.app')

@section('content')
        <div class="container d-flex flex-wrap justify-content-around">
            <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
                <div class="card text-center">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <i style="font-size: 80px;" class="fas fa-user-circle mb-3"></i>
                        <h2>{{$user->name}}</h2>
                        <p>{{$user->email}}</p>
                        <p>{{$user->address}}</p>
                        <p>{{$user->phone}}</p>
                        <a class="card-link m-1 btn btn-primary" href="{{route('user.edit', $user)}}">Edit details</a>
                        <a class="card-link m-1 btn btn-primary" href="{{route('user.passEdit', $user)}}">Change password</a>
                        <a class="card-link m-1 btn btn-danger" href="{{route('user.deleteConfirm', $user)}}">Delete account</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
