@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap justify-content-around">
        <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
            <div class="card text-center">
                <div class="card-body">
                    @if(session()->has('order'))
                        <h2>Booking was successful</h2>
                            <h3>{{session()->get('product')->title}}</h3>
                            <img class="mb-4 show-sm" src="{{session()->get('product')->image}}" alt="booking image">
                        <h4>Your booking details: </h4>
                        <p><b>Name: </b>{{session()->get('order')->user_name}}</p>
                        <p><b>Email: </b>{{session()->get('order')->user_email}}</p>
                        <p><b>Date: </b>{{session()->get('order')->date}}</p>
                        <p><b>Status: </b>{{session()->get('order')->status}}</p>
                        <a class="btn btn-primary btn-m" href="https://www.google.com/calendar/render?action=TEMPLATE&text=OBS+booking&dates={{session()->get('date')}}T050000Z/{{session()->get('date')}}T190000Z&details=Your+booking+for+{{session()->get('order')->orderProducts->title}}+with+OBS&sf=true&output=xml"
                        target="_blank">Add to Google calendar</a>
                    @else
                        <h5>No booking was made</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
