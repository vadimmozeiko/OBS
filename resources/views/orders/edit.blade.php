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
                            <form style="width: 100%;" method="POST" action="{{route('order.update', $order)}}"
                                  enctype="multipart/form-data">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                       name="name" value="{{old('name', $order->name)}}">
                                @error('name')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       name="email" value="{{old('email', $order->email)}}">
                                @error('email')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                       name="address" value="{{old('address', $order->address)}}">
                                @error('address')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
                                <input class="form-control @error('phone') is-invalid @enderror" type="number"
                                       name="phone" value="{{old('phone', $order->phone)}}">
                                @error('phone')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Booking date: *</span>
                                <input class="form-control @error('date') is-invalid @enderror"
                                       type="text" name="date" value="{{old('date', $order->date)}}" readonly>
                                <small class="d-block mt-3 mb-3">* Required info</small>
                                <input type="hidden" name="product_id" value="{{$order->orderProducts->id}}">
                                <input type="hidden" name="price" value="{{$order->orderProducts->price / 100}}">
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
