@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <h2 class="">Edit details</h2>
                        <div class="input-group">
                            <form style="width: 100%;" method="POST" action="{{route('user.update', $user)}}"
                                  enctype="multipart/form-data">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                       value="{{old('name', $user->name)}}" >
                                @error('name')
                                <small class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       name="email" value="{{old('email', $user->email)}}" >
                                @error('email')
                                <small class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                       name="address" value="{{old('address', $user->address)}}" >
                                @error('address')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
                                <input class="form-control @error('phone') is-invalid @enderror" type="number"
                                       name="phone" value="{{old('phone', $user->phone)}}" >
                                @error('phone')
                                <small class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <small class="d-block mb-3 mt-3">* Required info</small>
                                <button class="btn btn-primary btn-m" type="submit">Save</button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
