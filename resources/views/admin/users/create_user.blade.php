@extends('admin.dashboard')

@section('content')

    <h2 class="">Register new user</h2>
    <div class="pl-md-5 pr-md-5">
        <form method="POST" action="{{route('user.store')}}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-10 col-form-label text-md-left">{{__('Name')}}</label>

                <div class="col-md-10">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{old('name')}}" autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-10 col-form-label text-md-left">{{__('E-Mail Address')}}</label>

                <div class="col-md-10">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{old('email')}}" autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-10 col-form-label text-md-left">{{__('Address')}}</label>

                <div class="col-md-10">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                           name="address" value="{{old('address')}}" autocomplete="name" autofocus>

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-10 col-form-label text-md-left">{{__('Phone no.')}}</label>

                <div class="col-md-10">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                           value="{{old('phone')}}" autocomplete="name" autofocus>

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-10 col-form-label text-md-left">{{__('Password')}}</label>

                <div class="col-md-10">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                       class="col-md-10 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                <div class="col-md-10">
                    <input id="password-confirm" type="password"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation"
                           autocomplete="new-password">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-10">
                    <select class="form-control mb-3 @error('isAdmin') is-invalid @enderror" name="isAdmin">
                        <option value="">Select user type</option>
                        <option value="0">Customer</option>
                        <option value="1">Administrator</option>
                    </select>
                    @error('isAdmin')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="status_id" value="2">
            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{__('Register')}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
