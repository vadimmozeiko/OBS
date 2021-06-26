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
                            <form style="width: 100%;" method="POST" action="{{route('order.store')}}" enctype="multipart/form-data">
                                <span class="input-group-addon" id="basic-addon1">Full name *</span>
                                <input class="form-control mb-3" type="text" name="user_name" value="{{old('user_name', $user[0]->name)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Email *</span>
                                <input class="form-control mb-3" type="email" name="user_email" value="{{old('user_email', $user[0]->email)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Address *</span>
                                <input class="form-control mb-3" type="text" name="user_address" value="{{old('user_address' ,$user[0]->address)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Phone no. *</span>
                                <input class="form-control mb-3" type="number" name="user_phone" value="{{old('user_phone', $user[0]->phone)}}" required>
                                <span class="input-group-addon" id="basic-addon1">Booking date: *</span>
                                <input id="datepicker"  class="form-control mb-3" type="text" name="order_date" value="{{old('order_date', $request->order_date)}}">
                                <span class="input-group-addon" id="basic-addon1">Message</span>
                                <textarea class="form-control mb-3" name="user_message">{{old('user_message', $request->user_message)}}</textarea>
                                <small class="d-block mb-3">* Required info</small>
                                <input type="hidden" name="user_id" value="{{$user[0]->id}}">
                                <input type="hidden" name="product_id" value="{{$product}}">
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
