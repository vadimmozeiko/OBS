@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger"></div>
                    <div class="card-body">
                        <h2 class="">Delete Account</h2>
                        <p>Are you sure you want to delete your account?</p>
                        <p>If you delete your account, you will permanently lose your profile and all data.</p>
                        <p>Enter your password below to proceed your account deletion.</p>
                        <div class="input-group">
                            <form style="width: 100%;" method="POST" action="{{route('user.destroy', $user)}}" enctype="multipart/form-data">
                                <input class="form-control mb-3" type="password" name="current_password" required>
                                <button class="btn btn-danger btn-m" type="submit">Delete</button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
