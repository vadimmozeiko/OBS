@extends('layouts.app')

@section('content')
    @foreach($user as $person)
        <div class="container d-flex flex-wrap justify-content-around">
            <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h2>{{$person->name}}</h2>
                        <p>{{$person->email}}</p>
                        <p>{{$person->address}}</p>
                        <p>{{$person->phone}}</p>
                        <a class="card-link m-1 btn btn-primary" href="{{route('user.edit', $person)}}">Edit details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
