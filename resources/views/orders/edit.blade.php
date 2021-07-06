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
                            <form style="width: 100%;" method="POST" action="{{route('order.update', $order)}}" enctype="multipart/form-data">
                                <span class="input-group-addon" id="basic-addon1">Full name *</span>
                                <input class="form-control @error('user_name') is-invalid @enderror" type="text" name="user_name" value="{{old('user_name', $order->user_name)}}">
                                @error('user_name')
                                <small class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon" id="basic-addon1">Email *</span>
                                <input class="form-control @error('user_email') is-invalid @enderror" type="email" name="user_email" value="{{old('user_email', $order->user_email)}}">
                                @error('user_email')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon" id="basic-addon1">Phone no. *</span>
                                <input class="form-control @error('user_phone') is-invalid @enderror" type="number" name="user_phone" value="{{old('user_phone', $order->user_phone)}}">
                                @error('user_phone')
                                <small class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon" id="basic-addon1">Booking date: *</span>
                                <input id="datepicker"  class="form-control mb-3" type="text" name="order_date" value="{{old('order_date', $order->date)}}">
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
