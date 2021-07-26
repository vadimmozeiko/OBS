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
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                       name="name" value="{{old('name', $user->name)}}">
                                @error('name')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Email *</span>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                       name="email" value="{{old('email', $user->email)}}">
                                @error('email')
                                <small class="invalid-feedback " role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Address *</span>
                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                       name="address" value="{{old('address', $user->address)}}">
                                @error('address')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Phone no. *</span>
                                <input class="form-control @error('phone') is-invalid @enderror" type="number"
                                       name="phone" value="{{old('phone', $user->phone)}}">
                                @error('phone')
                                <small class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Booking date *</span>
                                <input id="datepicker" class="form-control @error('date') is-invalid @enderror" type="text" name="date"
                                       value="{{old('date', $request->order_date)}}">
                                <span class="input-group-addon d-block mt-3" id="basic-addon1">Message</span>
                                <textarea class="form-control mb-3"
                                          name="message">{{old('message', $request->message)}}</textarea>
                                <small class="d-block mb-3">* Required info</small>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="status" value="{{\App\Models\Order::STATUS_NOT_CONFIRMED}}">
                                <input type="hidden" name="order_number" value="{{$orderNumber}}">
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
