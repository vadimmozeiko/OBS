@extends('layouts.app')

@section('content')
    <div class="d-flex flex-wrap justify-content-center">
        <form class="w-75 " action="{{route('product.index')}}">
            <div class="form-row text-center justify-content-center">
                <div class="col-10 col-sm-4 col-md-4 col-lg-4">
                    <input id="datepicker" class="datepicker form-control mb-3 text-center" type="text"
                           name="order_date"
                           @if(!empty($request->order_date)) value="{{$request->order_date}}"
                           @else placeholder="Pick the date" @endif autocomplete="off" required>
                </div>
                <div>
                    <button class="btn btn-primary mb-3" type="submit">Check availability</button>
                </div>
            </div>
            @csrf
        </form>
    </div>
    <div class="container d-flex flex-wrap justify-content-around">
        @foreach($products as $product)
            <div style="cursor: pointer;" class="col-sm-12 col-md-6 col-lg-4 mb-5">
                <div class="card text-center p-4 h-100">
                    <div onclick="window.location='{{route('product.show', $product)}}'">
                        <img class="card-img-top w-75" src="{{$product->image}}" alt="Bounce Image">
                        <div class="card-body">
                            <h2 class="product-title mb-3">{{$product->title}}</h2>
                            <p>{{$product->category}}</p>
                            <p> &#128;{{$product->price / 100}} / 12 hours</p>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="
                            @if(!empty($request->order_date))
                        {{route('order.create', $product)}}"
                        @else
                            {{route('product.index')}}"
                        @endif>
                        <input type="hidden" name="order_date" value="{{$request->order_date}}">
                        <button type="submit" class="card-link btn btn-primary"
                                @if(($reserved->contains('product_id', $product->id)))
                                disabled>RESERVED
                        </button>
                        @else
                            >BOOK NOW</button>
                            @endif
                            @csrf
                            </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

