@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap justify-content-around">
        <div class="col-sm-10 col-md-8 col-lg-8 mb-5">
            <div class="card text-center">
                <div class="card-body">
                    <h4>Your booking details: </h4>
                    <img class="mb-4 show-sm" src="{{$order->orderProducts->image}}" alt="booking image">
                    <p><b>Name: </b>{{$order->user_name}}</p>
                    <p><b>Email: </b>{{$order->user_email}}</p>
                    <p><b>Date: </b>{{$order->date}}</p>
                    <p><b>Status: </b>{{$order->status}}</p>
                    <p><b>Price: </b>{{$order->price / 100}} Eur</p>
                    <div class="d-flex justify-content-center flex-wrap">
                        <a
                            @if($order->status == 'completed' ||
                                $order->status == 'cancelled')
                            style="pointer-events: none; background-color: #69bbff; border: none;"
                            @endif
                            class="btn btn-primary btn-m m-1"
                            href="https://www.google.com/calendar/render?action=TEMPLATE&text=OBS+booking&dates={{$order->date}}T050000Z/{{$order->date}}T190000Z&details=Your+booking+for+{{ $order->orderProducts->title }}+with+OBS&sf=true&output=xml"
                            target="_blank">Add to Google calendar</a>
                        <a
                            @if($order->status == 'completed' ||
                                $order->status == 'cancelled')
                            style="pointer-events: none; background-color: #69bbff; border: none;"
                            @endif
                            class="card-link btn btn-primary m-1" href="{{route('order.edit', $order)}}">Edit
                            booking</a>
                            <button class="card-link btn btn-danger m-1" type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                    @if($order->status == 'completed' ||
                                        $order->status == 'cancelled')
                                    disabled
                                @endif
                            >CANCEL
                            </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to cancel this booking?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{route('order.destroy', $order)}}">
                                            @csrf
                                        <button type="submit" class="btn btn-danger">YES</button>
                                        </form>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">NO</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
