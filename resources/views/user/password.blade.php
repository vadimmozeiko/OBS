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
                                <span class="input-group-addon" id="basic-addon1">Old password *</span>
                                <input class="form-control mb-3"  type="password" name="old_password"  required>
                                <span class="input-group-addon" id="basic-addon1">New password *</span>
                                <input class="form-control mb-3" type="password" name="new_password" required>
                                <span class="input-group-addon" id="basic-addon1">Confirm password *</span>
                                <input class="form-control mb-3" type="password" name="confirm_password" required>
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
