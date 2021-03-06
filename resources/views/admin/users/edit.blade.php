@extends('layouts.dashboard')

@section('content')
    <h2 class="">User #{{$user->id}} details</h2>
    <div class="input-group">
        <form style="width: 100%;" method="POST" action="{{route('update.user', $user)}}"
              enctype="multipart/form-data">
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
            <input class="form-control @error('name') is-invalid @enderror" type="text"
                   name="name" value="{{old('name', $user->name)}}"
                {{$user->status == \App\Models\User::STATUS_DELETED ? 'disabled' : ''}}>
            @error('name')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
            <input class="form-control @error('email') is-invalid @enderror" type="email"
                   name="email" value="{{old('email', $user->email)}}"
                {{$user->status == \App\Models\User::STATUS_DELETED ? 'disabled' : ''}}>
            @error('email')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
            <input class="form-control @error('address') is-invalid @enderror" type="text"
                   name="address" value="{{old('address', $user->address)}}"
                {{$user->status == \App\Models\User::STATUS_DELETED ? 'disabled' : ''}}>
            @error('address')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
            <input class="form-control @error('phone') is-invalid @enderror" type="number"
                   name="phone" value="{{old('phone', $user->phone)}}"
                {{$user->status == \App\Models\User::STATUS_DELETED ? 'disabled' : ''}}>
            @error('phone')
            <small class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Created at: </span>
            <input class="form-control" type="text" value="{{$user->created_at}}" disabled>
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Last time updated at: </span>
            <input class="form-control" type="text" value="{{$user->updated_at}}" disabled>
            <span class="input-group-addon d-block mt-3" id="basic-addon1">Status: </span>
            <input class="form-control" type="text" value="{{$user->status}}" disabled>
            <small class="d-block mt-3 mb-3">* Required info</small>
            <button class="btn btn-primary btn-m
            {{$user->status == \App\Models\User::STATUS_DELETED ? 'd-none' : ''}}" type="submit">Save
            </button>
            <a class="card-link btn btn-primary m-1"
               href="{{route('list.user')}}">Back</a>
            @csrf
        </form>
        <form method="POST" action="{{route('pass.reset', $user)}}">
            <button type="submit" class="card-link btn btn-warning m-1
                {{$user->status == \App\Models\User::STATUS_DELETED ? 'd-none' : ''}}"
            >Reset Password
            </button>
            @csrf
        </form>
    </div>
@endsection
