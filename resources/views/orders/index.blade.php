@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap justify-content-around">
        <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
            <div class="card text-center">
                <div class="card-body">
                    @if(session()->get('order'))
                        <h2>Booking was successful</h2>
                        @foreach(session()->get('product') as $product)
                            <h3>{{$product->title}}</h3>
                            <img src="{{$product->image}}" alt="booking image">
                        @endforeach
                        <h4>Your booking details: </h4>
                        <p><b>Name: </b>{{session()->get('order')->user_name}}</p>
                        <p><b>Email: </b>{{session()->get('order')->user_email}}</p>
                        <p><b>Date: </b>{{session()->get('order')->date}}</p>
                        <p><b>Status: </b>{{session()->get('order')->status}}</p>
                    @else
                        <h5>No booking was made</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
