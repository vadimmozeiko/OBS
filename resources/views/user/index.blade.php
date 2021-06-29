@extends('layouts.app')

@section('content')
    @foreach($user as $person)
        <div class="container d-flex flex-wrap justify-content-around">
            <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
                <div class="card text-center">
                    <div class="card-body">
                        <i style="font-size: 80px;" class="fas fa-user-circle mb-3"></i>
                        <h2>{{$person->name}}</h2>
                        <p>{{$person->email}}</p>
                        <p>{{$person->address}}</p>
                        <p>{{$person->phone}}</p>
                        <a class="card-link m-1 btn btn-primary" href="{{route('user.edit', $person)}}">Edit details</a>
                        <a class="card-link m-1 btn btn-primary" href="{{route('user.passEdit', $person)}}">Change password</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
