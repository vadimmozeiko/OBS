@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <h2 class="">Change password</h2>
                        <div class="input-group">
                            <form style="width: 100%;" method="POST" action="{{route('user.passUpdate', $user)}}" enctype="multipart/form-data">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Old password *</span>
                                <input class="form-control @error('old_password') is-invalid @enderror"  type="password" name="old_password">
                                @error('old_password')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">New password *</span>
                                <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password">
                                @error('new_password')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Confirm password *</span>
                                <input class="form-control @error('confirm_password') is-invalid @enderror" type="password" name="confirm_password">
                                @error('confirm_password')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <small class="d-block mt-3 mb-3">* Required info</small>
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
