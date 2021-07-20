@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <h2 class="">Fill the form</h2>
                        <div class="input-group">
                            <form style="width: 100%;" method="POST" action="{{route('order.store')}}"
                                  enctype="multipart/form-data">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Full name *</span>
                                <input class="form-control @error('user_name') is-invalid @enderror" type="text"
                                       name="user_name" value="{{old('user_name', $user->name)}}">
                                @error('user_name')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
                                <input class="form-control @error('user_email') is-invalid @enderror" type="email"
                                       name="user_email" value="{{old('user_email', $user->email)}}">
                                @error('user_email')
                                <small class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
                                <input class="form-control @error('user_address') is-invalid @enderror" type="text"
                                       name="user_address" value="{{old('user_address', $user->address)}}">
                                @error('user_address')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
                                <input class="form-control @error('user_phone') is-invalid @enderror" type="number"
                                       name="user_phone" value="{{old('user_phone', $user->phone)}}">
                                @error('user_phone')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Booking date *</span>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" type="text" name="date"
                                       value="{{old('date', $request->order_date)}}">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Message</span>
                                <textarea class="form-control mb-3"
                                          name="user_message">{{old('user_message', $request->user_message)}}</textarea>
                                <small class="d-block mb-3">* Required info</small>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="status_id" value="4">
                                <input type="hidden" name="price" value={{number_format($product->price / 100, 2)}}>
                                <button class="btn btn-primary btn-m" type="submit">BOOK</button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
