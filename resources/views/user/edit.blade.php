@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <h2 class="">Edit details</h2>
                        <div class="input-group ">
                            <form style="width: 100%;" method="POST" action="{{route('user.update', $user)}}" enctype="multipart/form-data">
                                <span class="input-group-addon" id="basic-addon1">Full name *</span>
                                <input class="form-control mb-3"  type="text" name="user_name" value="{{old('user_name', $user->name)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Email *</span>
                                <input class="form-control mb-3" type="email" name="user_email" value="{{old('user_email', $user->email)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Address *</span>
                                <input class="form-control mb-3" type="text" name="user_address" value="{{old('user_address', $user->address)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Phone no. *</span>
                                <input class="form-control mb-3" type="number" name="user_phone" value="{{old('user_phone', $user->phone)}}" required>
                                <small class="d-block mb-3">* Required info</small>
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
