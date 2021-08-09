@extends('layouts.app')


@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card mb-3 col-10 p-0  text-center">
            <div class="card-header"></div>
            <div class="row no-gutters bg-white position-relative">
                <div class="float-left w-50 pt-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2986.943975419043!2d-83.64655938432627!3d41.52715419528133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883c6e7465b56dd7%3A0xda0754fee48eee0a!2sOBS%20Financial!5e0!3m2!1slt!2slt!4v1628054515297!5m2!1slt!2slt" width="400" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>                </div>
                <div class="float-right w-50 pr-3 text-left">
                    <h2 class="mt-3 mb-4">Contact Us</h2>
                    <form method="POST" action="{{route('send.message')}}">
                        @csrf
                        <span class="input-group-addon d-block mt-3" id="basic-addon1">Name *</span>
                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                               name="name" value="{{old('name', auth()->user()->name ?? '')}}">
                        @error('name')
                        <small class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                        @enderror
                        <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                               name="email" value="{{old('email', auth()->user()->email ?? '')}}">
                        @error('email')
                        <small class="invalid-feedback " role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                        @enderror
                        <span class="input-group-addon d-block mt-3" id="basic-addon1">Message *</span>
                        <textarea class="form-control mb-3 @error('message') is-invalid @enderror"
                                  name="message" rows="6">{{old('message')}}</textarea>
                        @error('message')
                        <small class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                        @enderror
                        <small class="d-block mb-3">* Required info</small>
                        <div class="g-recaptcha" data-callback="enableBtn" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>
                        @if($errors->has('g-recaptcha-response'))
                            <small class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                            </small>
                        @endif
                        <input type="hidden" name="status" value="{{\App\Models\Contact::STATUS_NEW}}">
                        <button id="submit" class="btn btn-primary btn-m mb-2 mt-2" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
